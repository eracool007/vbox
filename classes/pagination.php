<?php
/**------------------------------------------------------
 * Pagination
 * 
 * Select page of records
 */
class Pagination{
    
    /**
     * Number of records to return;
     * @var integer $limit
     */
    public $limit;

    /**
     * Number of records to skip
     * @var integer $offset
     */
    public $offset;

    /**
     * page number of previous page
     * @var integer $previous
     */
    public $previous;

    /**
     * page number of next page
     * @var integer $next
     */
    public $next;

    /**
     * Keeps first record of the page
     * var int $firstRecordOfPage
     */
    public $firstRecordOfPage;

    /**------------------------------------------------------
     * object constructor
     * 
     * @param integer $page Page number
     * @param integer $recordsPerPage Number of record per page
     * @param integer $numberOfRecords Total number of records
     * 
     * @return void
     */
    public function __construct($page, $recordsPerPage, $numberOfRecords){

       $this->limit = $recordsPerPage;
       
       //check if int, if not pass 1 as a default in the third argument
       $page = filter_var($page, FILTER_VALIDATE_INT, [
           'options' => [
               'default' => 1,
               'min_range' => 1
               ]
        ]);
       
       if($page > 1) {
           $this->previous = $page - 1;
       } 
    
       $numberOfPages = ceil($numberOfRecords / $recordsPerPage);
       
       $this->firstRecordOfPage = ($page-1) * ($recordsPerPage) + 1 ;
       
       if($page < $numberOfPages){
           $this->next = $page + 1;
       }

       $this->offset = $recordsPerPage * ($page - 1);
    }
}