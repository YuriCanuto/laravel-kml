<?php

namespace App\Libs;

/**
 * SimpleXMLExtended Class
 *
 * Extends the default PHP SimpleXMLElement class by
 * allowing the addition of cdata
 *
 * @since 1.0
 *
 * @param string $cdata_text
 */
class SimpleXMLExtended extends \SimpleXMLElement
{
    /**
     * Cria um método com nome addCData
     * Recebe dois paramêtros : $name e value
     * @param  string $name => Será o nome do nó
     * @return string $value => O valor atribuido
     */
    public function addCData($name, $value = null) {
        /**
        * Criamos aqui um nó, usando
        * o método addChild do SimpleXMLElement
        */
        $child = $this->addChild($name);

        /**
         * Aqui Importamos o Nó do SimpleXMLElement
         * para um DOMElement
         */
        $node = dom_import_simplexml($child);

        /**
         * ownerDocument => Informamos que DomElement está associado a esse nó que criamos
         * createCDATASection => adiciona o conteúdo CData
         */
        $cdata  = $node->ownerDocument->createCDATASection($value);

        //Adicionar $cdata ao novo nó
        $node->appendChild($cdata);
    }
}
