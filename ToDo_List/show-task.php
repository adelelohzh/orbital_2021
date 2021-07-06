<?php 
    require('database_connection.php');
    $useruid = $_SESSION["useruid"];

    if (isset($_POST ['currentListId'])) {
        $list_id = $_POST['currentListId'];

        if ($list_id != null && $list_id != 0) {
            $list = $conn -> query("SELECT * FROM taskList WHERE listId = $list_id AND userId = '$useruid' ");
            $selectedList = $list -> fetch_assoc();
                if ($selectedList != null) 
                {
                    $listName = $selectedList['listName'];
                    $todoTasks = $conn -> query("SELECT * FROM tasks WHERE listId = '$list_id' AND userId = '$useruid' ORDER BY taskId ASC");
?>
          <div class="todoheader" id = "todoheader">
                <h2 class= "list-title" data-list-title><?php echo $listName?></h2>
            </div>

            <div class="todobody" >
                <div class="tasks" data-list-tasks>
                    <?php while($row = $todoTasks->fetch_assoc()) { ?>
                    <div class="task">
                        <input type="checkbox" class = "task-checkbox" id = "<?php echo $row['taskId']?>" <?php echo ($row['taskChecked']==1 ? 'checked' : '');?>/>
                        <label for = "<?php echo $row['taskId']?>" class = "name">
                            <span class = "custom-checkbox"></span>
                            <?php echo $row['taskName']?>
                        </label>
                        <label class = "deadline">
                                <?php if ($row['taskDeadline'] !== null) {
                                    echo $row['taskDeadline'];
                                } ?>  
                        </label>
                        <button class= "option-btn">
                            <i class = "material-icons" id = "<?php echo $row['taskId']?>">more_horiz</i>
                        </button>   
                        <div class="popout" id = "<?php echo $row['taskId']?>editorPopout">
                            
                            <div class="popout-content" >
                                <h1 class = "task-title">Task</h1>

                                <div class="cancel">
                                    <button class = "cancel-btn" id = "<?php echo $row['taskId']?>"> X </button>
                                </div>

                                <div class = "edit-task">
                                    <form action = "" method = "POST" name = "editForm">
                                        <label> 
                                            Task Name: 
                                        </label>
                                        <input 
                                            type = "text"
                                            name = "newName"
                                            id = "<?php echo $row['taskId']?>editName"
                                            class = "edit task-name"
                                            placeholder= "task name"
                                        />
                                
                                        <label> 
                                            Deadline: 
                                        </label>
                                        <input 
                                            type = "date"
                                            name = "newDeadline"
                                            id = "<?php echo $row['taskId']?>editDeadline"
                                            class = "edit task-deadline"
                                            placeholder= "yyyy/mm/dd" 
                                        /> 
                                        <button class = "save-btn"  id = "<?php echo $row['taskId']?>"> Save </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="new-task-creator">
                    <form action = "add.php" method = "POST" autocomplete = "off">
                        <?php if (isset($_GET['mess']) && $_GET['mess'] == 'error') { ?>
                            <input type="text"
                            name = "taskname"
                            class = "new task"
                            data-new-task-input
                            placeholder="This is a required field"
                            aria-label="New Task Name"
                            />
                            <input type="hidden" id="currList" name="currList" value = "4">
                            <button type = "submit" name = "submit" class="btn-task" aria-label="create new task">+</button>
                        <?php } else { ?>
                            <input type="text"
                            name = "taskname"
                            class = "new task"
                            data-new-task-input
                            placeholder="New Task Name"
                            aria-label="New Task Name"
                            />
                            <input type="hidden" id="currList" name="currList" value = "4">
                            <button type = "submit" name = "submit" class="btn-task" aria-label="create new task">+</button>
                        <?php } ?>
                    </form>
                </div> 

                <div class="delete-tasks">
                    <button class = "btn-clear" data-clear-list>Clear Completed Tasks</button>
                    <button class = "btn-delete" data-delete-list>Delete List</button>
                </div>
        </div>


<?php 
            } else {
                

?>

        <div class="todoheader" id = "todoheader">
                <h2 class= "list-title" data-list-title>No List Selected</h2>
            </div>

            <div class="todobody">
            <p>
                Please select a list to start
            </p>
            </div>

<?php       }
        } else { 
?>
            <div class="todoheader" id = "todoheader">
                <h2 class= "list-title" data-list-title>No List Selected</h2>
            </div>

            <div class="todobody">
            <p>
                Please select a list to start
            </p>
            </div>
<?php } 
    }
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">

    currentListId = localStorage.getItem(localStorageKeyCurrentList) 

    errorPopoutBox = document.getElementById("errorpopout")

    errorPopoutBox.style.display = 'none'

    $(document).ready(function() {

        $('.task-checkbox').click(function(){
            const taskId = $(this).attr('id');

            $.post("update.php",
                {
                    taskId: taskId
                }
            ) 

        });

        $('.btn-clear').click(function(){

            $.post("delete.php",
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
                url: "edit.php", 
                data: {array : array}, 
                success: function(message) { 
                    if (message == 'missing-value-error') 
                    {
                        alert("missing values");
                    }
                }
            });
        }); 

        $('.btn-delete').click(function(){
            $.post("deleteList.php",
            {
                listId: currentListId
            },
            (data) => {
                currentListId =  null;
                save();
                window.location.reload();
            });
        });

        if (currentListId != null && currentListId != "null" && currentListId != 0) 
        {
            const hiddenInput = document.getElementById("currList");
            if (hiddenInput != null)
            {
                hiddenInput.value = currentListId;
            }
        }
        else
        {
            const hiddenInput = document.getElementById("currList");
            if (hiddenInput != null)
            {
                hiddenInput.value = 0;
            }
        }

        function save()
        {
            localStorage.setItem(localStorageKeyCurrentList, currentListId);
        }

        
    });

</script>