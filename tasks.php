<?php

function readTasksFromFile($filename = "tasks.txt") {
    $tasks = [];
    
    // Überprüfen, ob die Datei existiert
    if (file_exists($filename)) {
        // Datei einlesen
        $fileContent = file_get_contents($filename);
        
        // Aufteilen nach Zeilen
        $lines = explode("\n", $fileContent);
        
        foreach ($lines as $line) {
            // Leere Zeilen überspringen
            if (trim($line) === '') {
                continue;
            }
            
            // Aufgabe und Beschreibung trennen
            $parts = explode(' - ', $line, 2);
            
            if (count($parts) === 2) {
                $title = trim($parts[0]);
                $description = trim($parts[1]);
                
                // Aufgabe zum Array hinzufügen
                $tasks[] = [
                    'title' => $title,
                    'description' => $description
                ];
            }
        }
    }
    
    return $tasks;
}

// Aufgaben aus der Datei einlesen
$tasks = readTasksFromFile();

$html = "";

// HTML für die Tabelle erstellen
$html = "<div class=\"table-container\">";
$html .= "<table>";
$html .= "<tr><th>#</th><th>Aufgabe</th><th>Beschreibung</th></tr>";

// Zählvariable initialisieren
$counter = 1;

// Jede Aufgabe als Zeile in der Tabelle darstellen
foreach ($tasks as $task) {
    $html .= "<tr>";
    $html .= "<td>" . $counter . "</td>";
    $html .= "<td>" . htmlspecialchars($task['title']) . "</td>";
    $html .= "<td>" . htmlspecialchars($task['description']) . "</td>";
    $html .= "</tr>";
    
    // Zählvariable erhöhen
    $counter++;
}

$html .= "</table>";
$html .= "</div>";

// Ausgabe des HTML
echo $html;
