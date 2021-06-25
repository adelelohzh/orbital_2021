const myLists = document.querySelector('[data-lists]')
const newListForm = document.querySelector('[data-new-list-form]')
const newListInput = document.querySelector('[data-new-list-input]')

const taskList = document.querySelector('[data-tasks]') 
const listTitle = document.querySelector('[data-list-title]')
const listTasks = document.querySelector('[data-list-tasks]')

const deleteListBtn = document.querySelector('[data-delete-list]')
const clearListBtn = document.querySelector('[data-clear-list]')

const taskTemplate = document.getElementById('task-template')
const newTaskForm = document.querySelector('[data-new-task-form]')
const newTaskInput = document.querySelector('[data-new-task-input]')

const cancelPopoutBtn = document.querySelector('[data-cancel-popout]')

const editTaskForm = document.querySelector('[data-edit-task-form]')
const editTaskNameInput = document.querySelector('[data-edit-task-name-input]')
const editTaskDeadlineInput = document.querySelector('[data-edit-task-deadline-input]')

const closeErrorBtn = document.querySelector('[data-close-error-popout]')

const localStorageKey = 'my.list'
const localStorageKeyCurrentList = 'current.list.selection'
const localStorageKeyCurrentTask = 'current.task.selection'

const errorPopout = document.querySelector('[data-error-popout]')
const popoutBox = document.querySelector('[data-popout]')

let lists = JSON.parse(localStorage.getItem(localStorageKey)) || []
let currentListId = localStorage.getItem(localStorageKeyCurrentList) 

closeErrorBtn.addEventListener('click', event => 
{
    errorPopout.style.display = 'none'
})


editTaskForm.addEventListener('submit' , event => 
{
    event.preventDefault()
    const newTaskName = editTaskNameInput.value
    const newTaskDeadline = editTaskDeadlineInput.value

    const currentList = lists.find(list => list.id === currentListId)
    const currentTaskId = localStorage.getItem(localStorageKeyCurrentTask) 
    const currentTask = currentList.tasks.find(task => task.id === currentTaskId)

    if (newTaskName === '') 
    {
        if (newTaskDeadline !== '') 
        {
            const newDeadline = new Date(newTaskDeadline.toString())
            currentTask.deadline = newDeadline 
            savePage()
            init()
        }
        else 
        {
            errorPopout.style.display = ''
        }
    } 
    else
    {
        currentTask.name = newTaskName
        if (newTaskDeadline !== '') 
        {
            const newDeadline = new Date(newTaskDeadline.toString())
            currentTask.deadline = newDeadline 
        }

        savePage()
        init()
    }

    popoutBox.style.display = 'none'
})


cancelPopoutBtn.addEventListener('click', event =>
{
    popoutBox.style.display = 'none'
})

clearListBtn.addEventListener('click', event => 
{
    const currentList = lists.find(list => list.id === currentListId)
    currentList.tasks = currentList.tasks.filter(tasks => !tasks.complete)
    savePage()
    init()
}) 

listTasks.addEventListener('click', event => 
{
    if (event.target.tagName.toLowerCase() === 'input') 
    {
        const currentList = lists.find(list => list.id === currentListId)
        const checkboxId = event.target.id
        const selectedTask = currentList.tasks.find(task => task.id === checkboxId)
        selectedTask.complete = event.target.checked
        savePage()
    } 
    else if (event.target.tagName.toLowerCase() === "i")
    {
        popoutBox.style.display = ''
        const currentList = lists.find(list => list.id === currentListId)
        const optionButtonId = event.target.id // isit optionbuttonid or isit i.id
        const selectedTask = currentList.tasks.find(task => task.id === optionButtonId)
        const currentTaskId = selectedTask.id
        localStorage.setItem(localStorageKeyCurrentTask, currentTaskId)
    }
})


deleteListBtn.addEventListener('click' , event =>
{
    const deleteListId = currentListId
    lists = lists.filter(element => element.id !== deleteListId)
    currentListId = null
    savePage()
    init()
})

myLists.addEventListener('click', event =>
{
    if (event.target.tagName.toLowerCase() === 'li')
    {
        const selectedListId = event.target.dataset.listId
        if (selectedListId === currentListId)
        {
            currentListId = null
        } 
        else
        {
            currentListId = selectedListId
        }
        savePage()
        init()
    }
})

newTaskForm.addEventListener('submit', event => 
{
    event.preventDefault()
    const taskName = newTaskInput.value
    if (taskName === '')
    {
        return
    } 
    const newTask = createTask(taskName)
    newTaskInput.value = null
    const currentList = lists.find(list => list.id === currentListId)
    currentList.tasks.push(newTask) 
    savePage()  
    init()
})

newListForm.addEventListener('submit', event => 
{
    event.preventDefault()
    const listName = newListInput.value
    if (listName === '')
    {
        return
    } 
    const newList = createList(listName)
    newListInput.value = null
    lists.push(newList) 
    savePage()  
    init()
})

function createList(newListName)
{
    return { 
        id: Date.now().toString(), 
        name: newListName, 
        tasks: [] 
    }
}

function createTask(taskName)
{
    return {
        id: Date.now().toString(),
        name: taskName,
        complete: false,
        deadline: ''
    }
}

function savePage()
{
    localStorage.setItem(localStorageKey, JSON.stringify(lists))
    localStorage.setItem(localStorageKeyCurrentList, currentListId)
}

function init () 
{
    clear(myLists)
    lists.forEach(listElement => {
        const listItem = document.createElement('li')
        listItem.dataset.listId = listElement.id
        listItem.classList.add("list-name")
        listItem.innerText = listElement.name 
        if (listElement.id === currentListId)
        {
            listItem.classList.add('active-list')
        }
        myLists.appendChild(listItem)
    }) 

    if (currentListId === null || currentListId === '')
    {
        taskList.style.display = 'none'
    } 
    else
    {
        const currentList = lists.find(list => list.id === currentListId)
        taskList.style.display = ''
        listTitle.innerText = currentList.name
        clear(listTasks)
        initTasks(currentList)
    }

    popoutBox.style.display = 'none'
    errorPopout.style.display = 'none'
}

function initTasks(currentList)
{
    currentList.tasks.forEach(t =>{
        const taskElement = document.importNode(taskTemplate.content, true)
        const checkbox = taskElement.querySelector('input')
        checkbox.id = t.id
        checkbox.checked = t.complete
        const nameLabel = taskElement.querySelector('.name')
        nameLabel.htmlFor = t.id
        nameLabel.append(t.name)
        const dateLabel = taskElement.querySelector('.deadline')
        dateLabel.htmlFor = t.id
        // if (t.deadline !== null)
        // {
        //     const currDeadline = new Date(t.deadline).toISOString().slice(0, 10)
        //     dateLabel.append(currDeadline)
        // }
        const optionBtn = taskElement.querySelector('[data-option-button]')
        optionBtn.id = t.id
        listTasks.appendChild(taskElement)
    })
}

function clear(selectedList)
{
    while (selectedList.firstChild)
    {
        selectedList.removeChild(selectedList.firstChild)
    }
}

init()