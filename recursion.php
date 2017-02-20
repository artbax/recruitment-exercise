<?php


try   
  {
    $licznik = 0;
    $db = new PDO('mysql:host=localhost; dbname=hragency', 'root', '');

    $query0 = "SELECT nazwisko, idPrzelozonego as idBoss  
              FROM users WHERE nazwisko LIKE :litera ";
    

    
    $result = $db->prepare($query0);
    $litera = "A%";
    $result->bindValue(':litera', $litera);

    $result->execute();

    //funkcja rekurencyjna
    function recursion($id, $db, $surname)
      {
              
              if($id == 0)
              {
                      echo "<b>null</b>";  
              }
              else
              {
                      global $licznik;
					  $query1 = "SELECT id, nazwisko, idPrzelozonego FROM users
								 WHERE id = :boss2";

					  $effect = $db->prepare($query1);
					  $effect->bindValue(':boss2', $id);
					  $effect->execute();
                      $licznik++;
                      $w = $effect->fetch();
                      
				      echo $w['nazwisko']."=>";
								         
					  recursion($w['idPrzelozonego'], $db, $w['nazwisko']);
                      
			  }
                      
              
      
      }


   
    while($row = $result->fetch())
    {
      $licznik++;
      echo $row['nazwisko']."=>";
      recursion($row['idBoss'], $db, $row['nazwisko']);
      echo "<br/>";
      
      
    }

    echo $licznik;


  }
catch (PDOException $e)
  {

    echo "Wystapil blad z baza danych". $e->getMessage();
   
  } 



?>
