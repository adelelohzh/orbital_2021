<?php 
    require('database_connection.php');
    $useruid = $_SESSION["useruid"];

    $todayDate = date("Y-m-d");

    $todoTasks = $conn -> query("SELECT * FROM tasks WHERE userId = '$useruid' AND taskDeadline = '$todayDate' ORDER BY taskId ASC");
?>

    <?php while($row = $todoTasks->fetch_assoc()) { 
        if ($row['taskChecked'] == 0) {?>
        <li class = "due-task" id = '<?php echo $row['listId']?>'>
            <div class = "task-name">
                <a href="../ToDo_List/todolist.php"><?php echo $row['taskName']?></a>
            </div>
            <div class = "task-list">
                <?php 
                    $listId = $row['listId'];
                    $list = $conn -> query("SELECT * FROM taskList WHERE userId = '$useruid' AND listId = '$listId'");
                    $taskList = $list->fetch_assoc()
                ?>
                <p><?php echo $taskList['listName']?></p>
            </div>
        </li>
    <?php } 
    }?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="javascript" type="text/javascript">

    const localStorageKeyCurrentList = 'current.list.selection' 
    currentListId = localStorage.getItem(localStorageKeyCurrentList);

    $('.due-task').click(function(){
            const listId = $(this).attr('id');

            localStorage.setItem(localStorageKeyCurrentList, listId);
        });

</script>

