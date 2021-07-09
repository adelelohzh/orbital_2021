<?php 
    require('database_connection.php');
    $useruid = $_SESSION["useruid"];

    $todayDate = date("Y-m-d");

    $maxNumber = 3;
    $currNumber = 0;

    $todoTasks = $conn -> query("SELECT * FROM tasks WHERE userId = '$useruid' ORDER BY taskDeadline ASC");
?>

    <?php while($row = $todoTasks->fetch_assoc()) {
        if ($currNumber < $maxNumber)
        {
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
                    <p> — &nbsp; <?php echo $taskList['listName']?></p>
                </div>
                <div class = "task-deadline">
                    <?php 
                        $deadline = $row['taskDeadline'];
                        if ($deadline == $todayDate) {
                    ?>
                        <p style="color:blue; font-size: 22px;">TODAY</p>
                    <?php } else if ($todayDate > $deadline) { ?>
                        <p style="color:red; font-size: 22px;">OVERDUE</p>
                    <?php } else { ?>
                        <p><?php echo $deadline?></p>
                    <?php } ?>
                </div>
            </li>
        <?php $currNumber++;
            } 
        }
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

