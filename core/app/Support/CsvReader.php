<?php

namespace App\Support;

use Generator;

class CsvReader
{
    /** @var int */
    const CHUNK_SIZE = 1000;

    /** @var resource|false */
    private $file;

    private int $iterator;

    private array|null $header;

    public function __construct( string $filename, private string $delimiter = "," )
    {
        $this->file = fopen($filename, 'r');

        $this->iterator = 0;

        $this->header = null;
    }

    /**
     * Return the csv file as chunk sized arrays of data.
     *
     * Example Usage in Seeder:
     *
     * $file = database_path('path/to/csvfile/XYZ.csv');
     * $csvReader = new CsvReader($file);
     *
     * $cur_time = now();
     *
     * foreach ($csvReader->toArray() as $data) {
     *     // Preprocessing of the array.
     *     foreach ($data as $key => $row) {
     *         // Laravel doesn't add timestamps on its own when inserting in chunks.
     *         $data[$key]['created_at'] = $cur_time;
     *         $data[$key]['updated_at'] = $cur_time;
     *     }
     *
     *     XYZModel::insert($data);
     * }
     */
    public function toArray() : Generator
    {
        $data = array();

        while (($row = fgetcsv($this->file, self::CHUNK_SIZE, $this->delimiter)) !== false)
        {
            $isMultipleOfChunkSize = false;

            if (!$this->header) {
                $this->header = $row;
            }
            else {
                $this->iterator++;

                $data[] = array_combine($this->header, $row);

                if ($this->iterator != 0 && $this->iterator % self::CHUNK_SIZE == 0) {
                    $isMultipleOfChunkSize = true;

                    $chunk = $data;
                    $data = array();

                    yield $chunk;
                }
            }
        }

        fclose($this->file);

        if ( !$isMultipleOfChunkSize ) {
            yield $data;
        }

        return;
    }
}
