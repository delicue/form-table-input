<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/output.css">
    <title>Book Entry</title>
</head>
<body>
    <?php
        require "./src/Header.php";
        require "./src/TableForm.php";
        require "./src/submit.php";
        
        use CueForm\Header;
        use CueForm\TableForm;
        use CueForm\TableInputData;

        $tableForm = new TableForm (
            [
                new Header("bookHeader", "Book", [
                    new Header("categoryHeader","Category"),
                    new Header("genreHeader", "Genre"),
                ]),
                new Header("libraryHeader", "Library"),
                new Header("authorHeader", "Author", [
                    new Header("genderHeader", "Gender"),
                    new Header("idHeader", "ID")
                ]),
                new Header("titleHeader", "Title"),
                new Header("dateHeader", "Entry Date")
            ], 3, null
        );

        TableInputData::submit($tableForm->bodyInputs)
        echo $tableForm;
    ?>
    <!-- <script src="./TableEvents.js"></script> -->
</body>
</html>