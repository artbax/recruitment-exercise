<?php

 
 try
 {
     $db = new PDO('mysql:host=localhost; dbname=hragency', 'root', '');

     $query = "INSERT INTO users (imie, nazwisko, idPrzelozonego) 
               VALUES (:name, :surname, :boss_id)";

     $query_prepare = $db->prepare($query);

     for($j = 0; $j <= 1000; $j++)
     {

        $lengthOfName = rand(7, 20);
		$lengthOfSurname = rand(12, 23);

		$name = '';
		$surname = '';

		for($i = 0; $i < $lengthOfName; $i++)
		{
			 $name = $name.chr(rand(97, 122));
		}

		for($i = 0; $i < $lengthOfSurname; $i++)
		{
			 $surname = $surname.chr(rand(97, 122));
		}

		$nameToDatabase = ucfirst($name);
		$surnameToDatabase = ucfirst($surname);
		$idOfBoss = rand(0, 20);
        if($idOfBoss == $j + 1)
        {
           $idOfBoss = $j + 3;
        }

		$query_prepare->execute(array(
                     ':name' => $nameToDatabase,
                     ':surname' => $surnameToDatabase,
                     ':boss_id' => $idOfBoss)
        );

      }
     
     
 }
 catch (PDOException $e)
 {
    echo "Wystapil blad z baza danych". $e->getMessage();
    
 }
 






?>
