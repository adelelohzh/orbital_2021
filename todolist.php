<?php
    session_start();
?>

<!DOCTYPE html>
    <html>
        <title>myNUS</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <style>
            <?php include 'styleHeader.css'; ?>
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
                <!-- <li class = "list-name active-list">CS1010J</li>
                <li class = "list-name">CS1231</li> -->
            </ul>

            <form action="" data-new-list-form>
                <input type="text"
                class = "new list"
                data-new-list-input
                placeholder="new list name"
                aria-label="new list name"
                />
                <button class="btn-list" aria-label="create new list">+</button>
            </form> 
        </div>

        <div class="todo-list" data-tasks>
            <div class="todoheader">
                <h2 class= "list-title" data-list-title>One</h2>
            </div>
            <div class="todobody" >
                <div class="tasks" data-list-tasks>
                    
                    <!-- <div class="task">
                        <input 
                        type="checkbox"
                        id = "task-1"
                        />
                        <label for = "task-1">
                            <span class = "custom-checkbox"></span>
                            assignment1
                        </label>
                    </div>
                    
                    <div class="task">
                        <input 
                        type="checkbox"
                        id = "task-2"
                        />
                        <label for = "task-2">
                            <span class = "custom-checkbox"></span>
                            assignment2
                        </label>
                    </div> -->

                </div>

                <div class="new-task-creator">
                    <form action="" data-new-task-form>
                        <input type="text"
                        class = "new task"
                        data-new-task-input
                        placeholder="new task name"
                        aria-label="new task name"
                        />
                        <button class="btn-task" aria-label="create new task">+</button>
                    </form>
                </div> 

                <div class="delete-tasks">
                    <button class = "btn-delete" data-clear-list>Clear Completed Tasks</button>
                    <button class = "btn-delete" data-delete-list>Delete List</button>
                </div>
            </div>
        </div>

        <div class="popout" data-popout>
            <div class="popout-content">
                <h1 class = "task-title">Task</h1>

                <div class="cancel">
                    <button class = "cancel-btn" data-cancel-popout> X </button>
                </div>

                <div class = "edit-task">
                    <form action = "" data-edit-task-form>
                        <label> 
                            Task Name: 
                        </label>
                        <input 
                            type = "text"
                            data-edit-task-name-input
                            class = "edit task-name"
                            placeholder= "task name"
                        />
                
                        <label> 
                            Deadline: 
                        </label>
                        <input 
                            type = "date"
                            data-edit-task-deadline-input
                            class = "edit task-deadline"
                            placeholder= "yyyy/mm/dd" 
                        /> 
                        <button class = "save-btn"> Save </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="errorPopout" data-error-popout>
            <div class="errorPopout-content">
                <h1 class = "task-title">Error</h1>
                <div class="errorMessage">
                    <p>Please enter a value!</p>
                </div>
                <button class = "close-btn" data-close-error-popout> Close </button>
            </div>
        </div>

        </div>
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
            </div>
        </template>
    </body>
</html>