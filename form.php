<h1>Databases auflisten</h1>
<?php 
if (isset($_POST['tables'])) {
    try {
        echo '<h3>'.$_POST['tables'].'</h3>';
        
        $schema = $_POST['tables'];
        $selectTables = 'show tables from '.$schema;

        ?>
        <form method="post">
            <input type="text" name="databaseSchema" value="<?php echo $schema ?>" hidden>
            <?php showTableWithMultipleButtons($selectTables); ?>
        </form>
        <?php              

    } catch (Exception $e) {
        echo 'Fehler beim Aufrufen des Schemas! '.$e->getCode().': '.$e->getMessage();
    }  
}
elseif (isset($_POST['description']) && isset($_POST['databaseSchema'])) {
    try {
        $desc = $_POST['description'];
        $databaseSchema = $_POST['databaseSchema'];

        $useQuery = 'use '.$databaseSchema;
        $stmt = makeStatement($useQuery);

        $selectDescription = 'describe '.$desc;
        
        showTable($selectDescription);

    } catch (Exception $e) {
        echo 'Fehler beim Aufruf der Table description! '.$e->getCode().': '.$e->getMessage();
    }
}
elseif (isset($_POST['content']) && isset($_POST['databaseSchema'])) {
    try {
        $cont = $_POST['content'];
        $databaseSchema = $_POST['databaseSchema'];

        $useQuery = 'use '.$databaseSchema;
        $stmt = makeStatement($useQuery);

        $selectContent = 'select * from '.$cont;

        showTable($selectContent);

    } catch (Exception $e) {
        echo 'Fehler beim Aufruf des Table content! '.$e->getCode().': '.$e->getMessage();
    }
}  
else {
    ?>
        <form method="post">
            <?php  
                $query = 'show databases';
                showTableWithButton($query);
            ?>
        </form>
    <?php
}