<?php include('server.php') ?>
<!DOCTYPE html>
    <html lang="pl">
        <head>
            <meta charset="UTF-8">
            <title>Formular to transfers</title>
            <link type="text/css" rel="stylesheet" href="style.css?<?php echo time(); ?>" />

		          <style type="text/css">
		                p {font-family: Arial}
		          </style>

        </head>
    <body>

        <div class="header">
    		<h2>Make Fake Transfer: </h2>
    	</div>


    <form action="formularz.php" method="post" autocomplete="off">

    <div class = "input-group">
        <label for="Na">On</label>
        <select name="Destination" id="selector" required>
                <option value="Account">Account</option>
                <option value="Card">Card</option>
                <option value="Smartphone">Smartphone</option>
        </select>
    </div>

    <div class = "input-group">
        <label for="Nazwa odbiorcy">Recipient's Name</label>
        <input type="text" name="Recipients_Name" maxlength="50" placeholder="wpisz nazwę odbiorcy" required autofocus>
    </div>

    <div class = "input-group">
        <label for="Numer rachunku (32 - postać papierowa lub 26 - postać elektroniczna)">Account number</label>
        <input pattern="[0-9]{2}([ ][0-9]{4}){6}|[0-9]{26}"type="text" name="Account_Number" maxlength="32" placeholder="wpisz numer rachunku" required
        title="26 numerical characters or 32 numerical characters with spaces" id="accountnumber">
    </div>

    <div class = "input-group">
        <label for="Adres odbiorcy">Recipient's Adress</label>
        <input type="text" name="Recipients_Adress" maxlength="32" placeholder="wpisz adres odbiorcy">
    </div>

    <div class = "input-group">
        <label for="Tytuł przelewu">Transfer Title</label>
        <textarea name="Title" id="standardtextinput" required></textarea>
    </div>


    <div class = "input-group">
        <label for="Typ przelewu">Type of Transfer</label>
        <select name="Type_Of_Transfer" id="selector" required>
            <option value="Standard">wybierz typ przelewu</option>
            <option value="Standard">Standardowy</option>
            <option value="Instant">Natychmiastwowy</option>
        </select>
    </div>

    <div class = "input-group">
        <label for="Kwota przelewu">Amount</label>
        <input type="number" name="Amount" id="Kwota przelewu" maxlength="20" placeholder="wpisz kwotę przelewu" required>
    </div>

    <div class = "input-group">
        <button type="submit" class="btn" name="send" >Send</button>
        <button type="reset" class="btn">Reset</button>
    </div>
    </form>

    <footer>
        <p> Koniec </p>
    </footer>

</body>
</html>
