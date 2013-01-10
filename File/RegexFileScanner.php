<?php
/**
 * ZendApp
 *
 * PHP version 5.3
 *
 * @category ZendApp
 * @package  File
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @version  SVN: $ Revision: $
 * @date     $ Date: $
 * @link     default
 **/

declare(encoding='UTF-8');

namespace ZendApp\File;

/**
 * RegexFileScanner class
 *
 * searchs for files that match a regex under
 * a path recursively and returns the pathnames
 *
 * @category ZendApp
 * @package  File
 * @author   Francisco Marcos <fmarcos83@gmail.com>
 * @license  default
 * @link     default
 **/
class RegexFileScanner
{
    private $_path;
    private $_regex;

    /**
     * Takes a path to search and a regex to adjust the
     * searching
     *
     * @param (String) $path  path to search files
     * @param (String) $regex adjust the result of iterartion
     *
     * @return null
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function __construct($path, $regex)
    {
        $this->_regex = $regex;
        $this->_path = $path;
    }


    /**
     * returns file paths
     *
     * @return (array) paths to the filtered files
     * @author Francisco Marcos <fmarcos83@gmail.com>
     **/
    public function search()
    {
        $pathNames = array();
        $dirIterator = new \RecursiveDirectoryIterator($this->_path);
        $iterator = new \RecursiveIteratorIterator($dirIterator);
        $regex = new \RegexIterator(
            $iterator,
            $this->_regex
        );
        foreach ($regex as $regs) {
            $pathNames[] = $regs->getPathname();
        }
        return $pathNames;
    }
}
