<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Book Entry</title>
</head>
<body>
    <?php
        require "cue-form/src/Header.php";
        require "cue-form/src/TableForm.php";
        use CueForm\Header;
        use CueForm\TableForm;

        $tableForm = new TableForm (
            [
                new Header("bookHeader", "Book", [
                    new Header("categoryHeader","Category"),
                    new Header("genreHeader", "Genre")
                ]),
                new Header("authorHeader", "Author", [
                    new Header("genderHeader", "Gender"),
                    new Header("idHeader", "ID")
                ]),
                new Header("titleHeader", "Title"),
                new Header("dateHeader", "Entry Date")
            ],
            7,
            null);
        echo $tableForm;
    ?>
    <script src="./TableEvents.js"></script>
</body>
</html>