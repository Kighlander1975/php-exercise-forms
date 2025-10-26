<?php
session_start();

// Fehler aus Session holen und direkt wieder löschen (Flash-Message)
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error']);
unset($_SESSION['success']);
?>
<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>DBE-Formular-Übung</title>
        <style>
            html,
            body {
                height: 100%;
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                font-size: 16px;
                font-family: Arial, Helvetica, sans-serif;
            }

            body {
                background-color: #acacac;
                min-height: 100vh;
                display: grid;
                place-items: center;
            }

            main {
                background-color: white;
                width: 75vw;
                height: 90vh;
                border-radius: 25px;
                border: 1px solid black;
                box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.5);

                h1,
                h2,
                h3,
                h4,
                h5 {
                    width: auto;
                    padding: 3px 5px;
                    text-align: center;
                }

                hr {
                    width: 95%;
                    margin: 0 auto;
                }
                .message {
                    width: auto;
                    margin-left: 2rem;
                    margin-right: 2rem;
                    margin-bottom: 2rem;
                    padding: 8px 16px;
                    border-radius: 25px;
                }
                .error {
                    background-color: #ff7777;
                    border: 3px solid #f00;
                    color: #000;
                }
                .success {
                    background-color: #77ff77;
                    border: 3px solid #0f0;
                    color: #000;
                }

                                .eingaben {
                    margin-top: 2rem;
                    margin-bottom: 2rem;
                    display: flex;
                    gap: 1.5rem;
                    justify-content: space-evenly;
                    width: min(95%, 1000px);
                    margin-left: auto;
                    margin-right: auto;

                    .eingabe {
                        display: flex;
                        align-items: center;
                        gap: 1rem;
                        font-size: 1.25rem;
                        flex: 1 1 0;

                        input {
                            border-radius: 1.5625rem;
                            padding: 0.5rem 1rem;
                            box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.5);
                            width: 100%;
                            box-sizing: border-box;
                            transition: all 0.3s ease;

                            &:not([type="submit"]) {
                                border: 1px solid #3c3c3c;
                                background-color: #ebebeb;
                            }
                            
                            /* Fokus-Zustand für Input-Felder */
                            &:focus {
                                outline: none;
                                border: 2px solid #3d00ad;
                                box-shadow: 0 0 8px 2px rgba(61, 0, 173, 0.3);
                                background-color: #f5f5f5;
                                transform: scale(1.02);
                            }
                        }
                    }

                    .eingabe:nth-of-type(2) {
                        flex: 2.25 1 0;
                    }

                    .eingabe:first-child {
                        flex: 1.5 1 0;
                    }

                    .eingabe:last-child {
                        flex: 0 0 auto;
                        justify-content: center;

                        input[type="submit"] {
                            background-color: #3d00ad;
                            color: white;
                            font-weight: bold;
                            width: auto;
                            padding: 4px 16px;
                            border-radius: 1.5625rem;
                            box-shadow: 5px 5px 10px 0px rgba(0, 0, 0, 0.5);
                            border: none;
                            display: inline-block;
                            box-sizing: border-box;

                            min-height: 2.5rem;
                            line-height: 1.5rem;

                            &:hover {
                                background-color: #715b99;
                            }
                            
                            /* Fokus-Zustand für Submit-Button */
                            &:focus {
                                outline: none;
                                box-shadow: 0 0 8px 2px rgba(61, 0, 173, 0.5);
                                transform: scale(1.05);
                            }
                        }
                    }
                }

                .table-container {
                    width:auto;
                    margin-left: 2rem;
                    margin-right: 2rem;

                    table {
                        width:100%;
                        th {
                            text-align: left;
                        }
                        th:first-child,
                        td:first-child {
                            text-align: center;
                        }
                        th:first-child {
                            width: 5%;
                        }
                        th:last-child {
                            width: 75%;
                        }
                        /* Abwechselnde Hintergrundfarben für Zeilen */
                        tr:nth-child(even):not(:first-child) {
                            background-color: #f2f2f2;
                        }
                        tr:nth-child(odd):not(:first-child) {
                            background-color: #ffffff;
                        }
                    }
                }
            }
        </style>
    </head>
    <body>
        <main>
            <h1>Formular-Übung</h1>
            <?php if ($error): ?>
                <div class="message error"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <?php if ($success): ?>
                <div class="message success"><?php echo htmlspecialchars($success); ?></div>
            <?php endif; ?>
            <hr />
            <form action="action.php" method="post">
                <div class="eingaben">
                    <div class="eingabe">
                        <label for="task">Aufgabe: </label>
                        <input type="text" name="task" id="task" autofocus />
                    </div>
                    <div class="eingabe">
                        <label for="description">Beschreibung:</label>
                        <input
                            type="text"
                            name="description"
                            id="description"
                        />
                    </div>
                    <div class="eingabe">
                        <input type="submit" value="Eintragen" />
                    </div>
                </div>
            </form>
            <hr />
            <?php
                if (file_exists("./tasks.txt")) {
                    echo "<h2>Aufgaben:</h2>";
                    require_once "tasks.php";
                } else {
                    echo "<h3>Aktuell keine Aufgaben vorhanden</h3>";
                }
            ?>
        </main>
    </body>
</html>
