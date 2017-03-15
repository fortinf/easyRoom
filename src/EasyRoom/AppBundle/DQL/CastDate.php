<?php

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CastDate
 * 
 * CAST('2016-12-05' AS DATE)
 *
 * @author ffortin
 */
class CastDate extends FunctionNode{
    
    public $date = null;
    
    public function parse(Parser $parser) {
        $parser->match(Lexer::T_IDENTIFIER); // CAST
        $parser->match(Lexer::T_OPEN_PARENTHESIS); // (
        
        $this->date = $parser->ArithmeticPrimary(); // date ex: '1981-08-25'
        
        $parser->match(Lexer::T_IDENTIFIER); // AS 
        $parser->match(Lexer::T_IDENTIFIER); // DATE
        $parser->match(Lexer::T_CLOSE_PARENTHESIS); // )
    }
    
    public function getSql(SqlWalker $sqlWalker) {
        
        return 'CAST(' . $this->date->dispatch($sqlWalker) . ' AS DATE)';
        
    }
    
}
