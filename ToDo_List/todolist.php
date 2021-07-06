<?php

    require('includes/database_connection.php');

    $userid = $_SESSION['useruid'];

    $getquery = "SELECT * FROM taskName
                ORDER BY taskId DESC";

    $alltasks = mysqli_query($conn, $getquery);
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../ToDo_List/styleTodoList.css">
        <!-- <script src="scriptTodoList.js"></script> -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- <script src = 'scriptToDoList.js'></script> -->
        <style>
             <?php include '../Header/styleHeader.css'; ?>
        </style>

    <body class = "full grey">
     
    <!-- Header -->
    <div class = "header">
        <?php if (!isset($_SESSION["useruid"])) { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
        <?php } else { ?>
                <ul class = "header-left">
                    <li class = "nostyle inlineblock leftfloat centered"><a href='#' class = "nodeco mylogofont blockdisplay">my</a></li>
                    <li class = "nostyle inlineblock leftfloat centered"><a href='../Main/Main.php' class = "nodeco nuslogofont blockdisplay">NUS</a></li>
                </ul>
                <ul class = "header-right">
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Home</a></li>
                    <li class = "nostyle inlineblock"><a href='../Timetable/Timetable.php' class = "nodeco blockdisplay">Timetable</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">To-Do List</a></li>
                    <li class = "nostyle inlineblock"><a href='#' class = "nodeco blockdisplay">Shuttle Bus</a></li>
                    <li class = "nostyle inlineblock"><a href='../Login_Signup/includes/logout.inc.php' class = "nodeco blockdisplay">Logout</a></li>
                </ul>
        <?php } ?>       
    </div>
    <!-- End of header -->
    
    <div class = "to-do-body">
        <h1 class = "title">To-Do List</h1>

        <div class="all-tasks">
            <h2 class="tasks-list-title">Task Lists</h2>
            <ul class="task-list" data-lists>
                <?php 
                    $taskList = $conn -> query("SELECT * FROM taskList WHERE userId = '$userid' ORDER BY listId ASC");
                ?>
                <?php while($listRow = $taskList->fetch_assoc()) { ?>
                    <li class = "listElement" id = '<?php echo $listRow['listId']?>'> 
                        <?php echo $listRow['listName']?>
                    </li>
                <?php } ?>
            </ul>

            <form action="addList.php" method = "POST" autocomplete = "off">
                <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error1') { ?>
                    <input type="text"
                    name = "listName"
                    class = "new list"
                    data-new-list-input
                    placeholder="This is a required field"
                    aria-label="New List Name"
                    />
                    <button class="btn-list" aria-label="create new list">+</button>
                <?php } else { ?>
                    <input type="text"
                    name = "listName"
                    class = "new list"
                    data-new-list-input
                    placeholder="New List Name"
                    aria-label="New List Name"
                    />
                    <button class="btn-list" aria-label="create new list">+</button>
                <?php } ?>
            </form> 
        </div>

        <div class="todo-list">
                
                <div id = "todo-container">
                </div>
            
        </div>
                
        <div class="errorPopout" id = "errorpopout">
            <div class="errorPopout-content" >
                <h1 class = "task-title">Error</h1>
                <div class="errorMessage">
                    <p>Please enter a value!</p>
                </div>
                <button class = "close-btn"> Close </button>
            </div>
        </div>

        <!-- </div>
        <template id = "task-template">
            <div class="task">
                <input type="checkbox"/>
                <label class = "name">
                    <span class = "custom-checkbox"></span>
                </label>
                <label class = "deadline">
                    <span class = "deadline"></span>
                </label>
                <button class= "option-btn">
                    <i class = "material-icons" data-option-button>more_horiz</i>
                </button>
            </div> -->
        </template>
    </body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

    const localStorageKeyCurrentList = 'current.list.selection' 
    currentListId = localStorage.getItem(localStorageKeyCurrentList);

    var errorPopoutBox = document.getElementById("errorpopout")

    errorPopoutBox.style.display = 'none'

    $(document).ready(function() {

        function loadTasks() {
            $.ajax({ 
                    type: "POST", 
                    url: "includes/show-task.php", 
                    data: {currentListId : currentListId}, 
                    success: function(data) { 
                        $("#todo-container").html(data);
                    } 
            });
        }

        loadTasks();

        $('.task-checkbox').click(function(){
            const taskId = $(this).attr('id');

            $.post("includes/update.php",
                {
                    taskId: taskId
                }
            )

        });

        $('.btn-task').click(function(){
            $.post("includes/add.php", 
            {
                listId: currentListId
            })
        });

        $('.btn-clear').click(function(){

            $.post("includes/delete.php",
            {
                id: 100
            },
            (data) => {
                window.location.reload();
            });
        });

        $('.material-icons').click(function() {
            const taskId = $(this).attr('id');
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            popoutBox.style.display = 'flex'
        });

        $('.cancel-btn').click(function() {
            const taskId = $(this).attr('id');
            const popoutId = taskId.toString() + 'editorPopout'
            var popoutBox = document.getElementById(popoutId)
            popoutBox.style.display = 'none'
        });

        $('.save-btn').click(function() {
            const taskId = $(this).attr('id');
            const nameId = taskId.toString() + 'editName';
            const deadlineId = taskId.toString() + 'editDeadline';
            const newName = document.getElementById(nameId).value;
            const newDeadline = document.getElementById(deadlineId).value;

            let array = [taskId, newName, newDeadline]

            $.ajax({ 
                type: "POST", 
                url: "includes/edit.php", 
                data: {array : array}, 
                success: function(message) { 
                    if (message == 'missing-value-error') 
                    {
                        alert("missing values");
                    }
                }
            });
        }); 

        $('.listElement').click(function() {
            const listId = $(this).attr('id');
            if (currentListId != listId) //diff list
            {
                if (currentListId != null && currentListId != "null" && currentListId != 0)
                {
                    const currListItem = document.getElementById(currentListId);
                    if (currListItem == null)
                    {
                        currentListId = 'null';
                        save();
                    }
                    else
                    {
                        currListItem.classList.remove('active-list');
                    }
                }
                const listItem = document.getElementById(listId);
                listItem.classList.add('active-list');
                currentListId = listId;
                save();
            }
            else
            {
                const currlistItem = document.getElementById(currentListId);
                currlistItem.classList.remove('active-list');
                currentListId = 0;
                save();
            }
            init();
            loadTasks();
        })

        function init()
        {
            if (currentListId != null && currentListId != "null" && currentListId != 0)
            {
                const currListItem = document.getElementById(currentListId);
                if (currListItem == null)
                {
                    currentListId = 'null';
                    save();
                }
                else
                {
                    currListItem.classList.add('active-list');
                }
            }
        }

        init();

        function save()
        {
            localStorage.setItem(localStorageKeyCurrentList, currentListId);
        }

    });

</script>