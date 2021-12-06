<?php

namespace myorg\Csv;

use myorg\Exceptions\FileFormatException;
use myorg\Exceptions\SourceFileException;
use RuntimeException;
use SplFileObject;

class CsvLoader
{
    private $filename;
    private $columns;
    private $fileObject;

    private $result = [];
    private $error = null;

    /**
     * ContactsImporter constructor.
     * @param $filename
     * @param $columns
     */
    public function __construct(string $filename, array $columns)
    {
        $this->filename = $filename;
        $this->columns = $columns;
    }

    public function import(): void
    {
        if ( ! $this->validateColumns($this->columns)) {
            throw new FileFormatException("Заданы неверные заголовки столбцов");
        }

        if ( ! file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }

        try {
            $this->fileObject = new SplFileObject($this->filename);
        } catch (RuntimeException $exception) {
            throw new SourceFileException("Не удалось открыть файл на чтение");
        }

        $header_data = $this->getHeaderData();

        if ($header_data !== $this->columns) {
            throw new FileFormatException("Исходный файл не содержит необходимых столбцов");
        }

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }
    }

    public function getData(): array
    {
        return $this->result;
    }

    /**
     * @throws SourceFileException
     */
    public function writeToSql(string $fileName, string $table, string $filePath = ''): void
    {

        try {

            $newSqlFile = new SplFileObject($filePath . $fileName . '.sql', 'w+');

            foreach ($this->result as $line) {

                $content = sprintf("INSERT INTO %s(%s) VALUES (\"%s\");\r\n", $table,
                    implode(',', $this->getHeaderData()),
                    implode('", "', $line));

                $newSqlFile->fwrite($content);
            }
        } catch (\Exception) {
            throw new SourceFileException("Не удалось произвести запись в файл");
        }

    }


    private function getHeaderData(): ?array
    {
        $this->fileObject->rewind();
        $data = $this->fileObject->fgetcsv();

        return $data;
    }

    private function getNextLine(): ?iterable
    {
        $result = null;

        while ( ! $this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }

        return $result;
    }

    private function validateColumns(array $columns): bool
    {
        $result = true;

        if (count($columns)) {
            foreach ($columns as $column) {
                if ( ! is_string($column)) {
                    $result = false;
                }
            }
        } else {
            $result = false;
        }

        return $result;
    }
}