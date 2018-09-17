<?php

class User {
    
    public function userRegister($postData) {        
        // Kollar om användarnamnet är upptaget med hjälp av file_exists och även om användaren har angett username/password
        if (file_exists($postData['username'] . ".csv")) {
            echo "Sorry, the username: " . $postData['username'] . " is taken.";
        } elseif ($postData['username'] == "" && $postData['userPassword'] == "") {
            echo "Enter your username and password.";
        } else {
            // Om inte användarnamnet är upptaget så skriver den användarnamnet och lösenordet (saltat) till en csv-fil
            $hashedPass = password_hash($postData['userPassword'], PASSWORD_DEFAULT);
            $string = $postData['username'] . "," . $hashedPass;
            $fileHandle = fopen($postData['username'] . ".csv", "w+");
            fwrite($fileHandle, $string);
            fclose($fileHandle);
            // Byter sedan location till inloggnings sidan
            header("Location: http://localhost/lab2/index.php", true, 301);
            exit();
        }
    }
    

    public function userLogin($loginData) {
        // Kollar så att användarnamnet man skriver in matchar filnamnet som blev satt när man skapade ett nytt konto
        // Om det lyckas så lägger jag filen i en array    
        if ($loginData['username'] . ".csv" == file_exists($loginData['username'] . ".csv")) {
            $csv = array_map('str_getcsv', file($loginData['username'] . ".csv"));
            
            // Kollar om det angivna lösenordet matchar med saltet
            // Om det matchar sparar jag användarnamnet i SESSION variablen och skickar sedan användaren vidare till välkomssidan
            $isCorrect = password_verify($loginData['userPassword'], $csv[0][1]);
            if ($isCorrect) {
                $_SESSION['username'] = $loginData['username'];
                ?>
                <!-- Testar även att redirecta med hjälp av javascript vilket verkar fungera fint -->
                <script type="text/javascript">
                    document.location.href = 'welcome.php';
                </script>;
                <?php
                exit();
            } else {
                echo "Wrong username or password.";
            }
        // Skriver ut att både användarnamn och lösenord är fel pga säkerhet. 
        } else {
            echo "Wrong username or password.";
        }  
    }

    public function userLogout($logoutData) {
        // Om användaren klickar på logout så töms SESSION värdena och man blir redirectad till startsidan
        unset($_SESSION['username']);
        header("Location: http://localhost/lab2/index.php", true, 301);
        exit();
    }

}