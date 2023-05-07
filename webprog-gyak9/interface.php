<?php

interface PersonsApi {
    function getPersons(): array;
    function getPersonsOverAge(int $age): array;
}

abstract class PersonsFromWhatever implements PersonsApi {
    abstract function getPersons(): array;

    function getPersonsOverAge(int $age): array {
        $result = [];
        foreach ($this->getPersons() as $person) {
            if ($person['age'] >= $age) {
                $result[] = $person;
            }
        }
        return $result;
    }
}

class PersonsFromCSV extends PersonsFromWhatever {
    function getPersons(): array {
        return json_decode(file_get_contents('persons.json'), true);
    }
}


class PersonsFromJSON extends PersonsFromWhatever {
    function getPersons(): array {
        $personsFromCSV = [];
        $personsCSVFile = fopen('persons.csv', 'r');

        $headers = fgetcsv($personsCSVFile, NULL, ',');
        while($row = fgetcsv($personsCSVFile, NULL, ',')) {
            // print_r($row);
            $personsFromCSV[] = array_combine($headers, $row);
        }

        fclose($personsCSVFile);

        return $personsFromCSV;
    }
}


?>

<?php

$personsAPI = new PersonsFromCSV();

?>

<h1>All persons</h1>
<ul>
    <?php foreach ($personsAPI->getPersons() as $person) : ?>
    <li>
        <?= $person['name'] ?>
    </li>
    <?php endforeach; ?>
</ul>

<?php
    $ageFilter = $_GET['age'] ?? NULL;
?>

<h1>Filtered persons</h1>
<form action="">
    <input type="number" name="age" />
    <button type="submit">Submit</button>
</form>

<?php
if (is_numeric($ageFilter)):
?>
    <ul>
        <?php foreach ($personsAPI->getPersonsOverAge($ageFilter) as $person) : ?>
            <li>
                <?= $person['name'] ?>,
                <?= $person['age'] ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php
endif;
?>
