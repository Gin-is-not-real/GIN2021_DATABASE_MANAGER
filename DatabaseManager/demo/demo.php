<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo Database Manager</title>
</head>
<body>
    <header>
        <h1>2021_DATABASE_MANAGER</h1>
        <h2>Demo script</h2>
    </header>

    <main>
        <article>
            <section>
                <header>
                    <h3>Configuration</h3>
                </header>
                <div>
                    <p>The object uses the values stored in a json configuration file to connect to the server.</p>
                    <p>The first step is to edit the configuration file with your information.</p>
                    <p>For this demo, the configuration file is located at /GIN2021_DATABASE_MANAGER/DatabaseManager/demo/conf.demo.json</p>
                    <p><strong>First, please edit the file with put your own informations</strong></p>
                </div>
            </section>

            <section>
                <header>
                    <h3>Check if exist</h3>
                </header>
                <div>
                    <p>Using server informations, you can test if a base exist.</p>
                   <!-- mettre formulaire pour appeler class method check base en AJAX -->
                </div>
                <div>
                    <p>Using server and base informations, you can test if a table exist on base</p>
                    <!-- mettre formulaire pour appeler class method check table en AJAX -->
                </div>
            </section>
        </article>


    </main>

</body>
</html>





