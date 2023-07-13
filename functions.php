<?php 
function makeStatement($query, $valueArray = null)
{
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute($valueArray);
    return $stmt;
}

function showTable($query, $valueArray=null)
{
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute($valueArray);
    $meta = array(); //save attribute properties

    echo '<table class="table"><tr>';

    //column name
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); //attribute properties
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>' . $r . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function showTableWithButton($query)
{
    global $con;
    $stmt = $con->prepare($query);
    $stmt->execute();
    $meta = array(); //save attribute properties

    echo '<table class="table"><tr>';

    //column name
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); //attribute properties
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '<th></th>';
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>' . $r . '</td>';
            echo '<td><button class="btn btn-outline-info" type=submit name="tables" value="'.$r.'">Tables</button></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

function showTableWithMultipleButtons($query, $valuearray=null)
{
    global $con;
    $stmt = $con->prepare($query);
    //$stmt->bindValue(1, "jobify");
    $stmt->execute($valuearray);

    
    $meta = array(); //save attribute properties

    echo '<table class="table"><tr>';

    //column name
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $meta[] = $stmt->getColumnMeta($i); //attribute properties
        echo '<th>' . $meta[$i]['name'] . '</th>';
    }
    echo '<th></th>';
    echo '<th></th>';
    echo '</tr>';

    while ($row = $stmt->fetch(PDO::FETCH_NUM))
    {
        echo '<tr>';
        foreach ($row as $r)
        {
            echo '<td>' . $r . '</td>';
            echo '<td><button class="btn btn-outline-info" type=submit name="description" value="'.$r.'">Description</button></td>';
            echo '<td><button class="btn btn-outline-secondary" type=submit name="content" value="'.$r.'">Content</button></td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}