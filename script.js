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

const localStorageKey = 'my.list'
const localStorageKeyCurrentList = 'current.list.selection'

let lists = JSON.parse(localStorage.getItem(localStorageKey)) || []
let currentListId = localStorage.getItem(localStorageKeyCurrentList) 

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
        id: Date.now.toString(),
        name: taskName,
        complete: false
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
}

function initTasks(currentList)
{
    currentList.tasks.forEach(t =>{
        const taskElement = document.importNode(taskTemplate.content, true)
        const checkbox = taskElement.querySelector('input')
        checkbox.id = t.id
        checkbox.checked = t.complete
        const label = taskElement.querySelector('label')
        label.htmlFor = t.id
        label.append(t.name)
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