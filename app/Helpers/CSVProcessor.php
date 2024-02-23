<?php 
namespace App\Helpers;

class CSVProcessor
{
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function read()
    {
        $data = [];
        if (($handle = fopen($this->filePath, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = $row[0];
            }
            fclose($handle);
        }
        // remove index 0 from the array - in this example it's the header row
        array_shift($data);

        return $data;
    }

    public function process()
    {
        $rows = $this->read();
        $homeOwners = [];
        foreach ($rows as $row) {
            // Use array_merge to flatten the array structure
            $homeOwners = array_merge($homeOwners, $this->_processPersonData($row));
        }
        return $homeOwners;
    }

    private function _processPersonData($input)
    {
        $titles = ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof', 'Mister']; // Define known titles
        $connectors = [' and ', ' & ']; // Define connectors for splitting entries representing multiple people
        $people = [];

        // Check and split the input on connectors to handle multiple people in one string
        foreach ($connectors as $connector) {
            if (strpos($input, $connector) !== false) {
                // Split the input into parts (e.g., "Mr and Mrs Smith" -> ["Mr", "Mrs Smith"])
                $parts = explode($connector, $input);
               
                // Assume the last name is shared and extract it
                $lastName = '';
                if (preg_match('/\b(\w+)$/', $input, $matches)) {
                    $lastName = $matches[1]; // Capture the last word as the last name
                }
                // Process each part as a separate person
                foreach ($parts as $part) {
                    $trimmedPart = trim($part);
                    // If the part doesn't contain a title, prepend the shared title (if any) to it
                    if (!preg_match('/^(' . implode('|', $titles) . ')\b/', $trimmedPart)) {
                        $trimmedPart = $titles[0] . " " . $trimmedPart; // Prepend the first found title as a default
                    }
                    // Rebuild the input to include the last name if it was split off
                    if (!preg_match('/\b' . preg_quote($lastName, '/') . '\b/', $trimmedPart)) {
                        $trimmedPart .= ' ' . $lastName;
                    }
                    $people = array_merge($people, $this->_processSinglePerson($trimmedPart));
                }
                return $people; // Return early as we've processed the special case
            }
        }
    

        // If no connectors were found, process the input as a single person
        $people = array_merge($people, $this->_processSinglePerson($input));
        
        return $people;
    }

    // New method to process a single person entry
    private function _processSinglePerson($input)
    {
        $titles = ['Mr', 'Mrs', 'Ms', 'Dr', 'Prof', 'Mister']; // Define known titles
        
               
        // Split the entry into words

        $words = explode(' ', trim($input));
        $person = ['title' => null, 'first_name' => null, 'initial' => null, 'last_name' => null];

        if(sizeof($words) == 4){
            array_pop($words);
        }
        foreach ($words as $index => $word) {
            if (in_array($word, $titles)) {
                $person['title'] = $word;
            } elseif ($index === count($words) - 1) { // Last word is always considered as last name
                $person['last_name'] = $word;
            } elseif (strlen($word) === 2 && $word[1] === '.' || strlen($word)===1) { // A single letter followed by a dot is or is one letter  treated as an initial 
                $person['initial'] = $word[0];
            } elseif (empty($person['first_name'])) { // The first word after the title that doesn't fit the initial criteria is the first name
                $person['first_name'] = $word;
            }
        }
        return [$person];
    }
}
