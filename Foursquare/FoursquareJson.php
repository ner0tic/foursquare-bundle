<?php
namespace Ner0tic\FoursquareBundle\Foursquare;

use \ArrayAccess,
    \Countable,
    \IteratorAggregate,

    Ner0tic\FoursquareBundle\Exception\FoursquareException;


class FoursquareJson implements ArrayAccess, Countable, IteratorAggregate 
{
    private 
        $debug,
        $_response;
    
    /**
     * @param object $response
     * @param boolean $debug
     */
    public function __construct( $response, $debug = false ) 
    {
        $this->_response = $response;
        $this->debug  = $debug;
    }
    
    /**
     * Deconstruct json response
     */
    public function __destruct() 
    { 
        $this->responseText; 
    }
    
    /**
     * @inheritdoc
     */
    public function getIterator() 
    {
        if( $this->__obj )
        {
            return new ArrayIterator( $this->__obj );
        }
        else 
        {
          return new ArrayIterator( $this->response );   
        }
    }
    
    /**
     * @inheritdoc
     */
    public function count() 
    { 
        return count( $this->response ); 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetSet( $offset, $value )
    { 
        $this->response[ $offset ] = $value; 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetExists( $offset )
    { 
        return isset( $this->response[ $offset ] ); 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetUnset( $offset )
    {
        unset( $this->response[ $offset ] ); 
    }
    
    /**
     * @inheritdoc
     */
    public function offsetGet( $offset )  
    { 
        return isset( $this->response[ $offset ] ) ? $this->response[ $offset ] : null; 
    }
    
    /**
     * Get item
     * @param string $name
     * @return string|null
     */
    public function __get( $name ) 
    {
        $accessible = array(
            'responseText'  =>  1,
            'headers'       =>  1,
            'code'          =>  1
        );
        $this->responseText = $this->_response->data;
        $this->headers      = $this->_response->headers;
        $this->code         = $this->_response->code;
        
        if( isset( $accessible[ $name ] ) && $accessible[ $name ] )
        {
            return $this->$name;
        }
        elseif( ( $this->code < 200 || $this->code >= 400 ) && !isset( $accessible[ $name ] ) )
        {
            FoursquareException::raise( $this->_response, $this->debug );
        }
        
        $this->response     = json_decode( $this->responseText, 1 );
        $this->__obj        = json_decode( $this->responseText );

        if( gettype( $this->__obj ) === 'object' ) 
        {
            foreach( $this->__obj as $k => $v )
            {
                $this->$k = $v;
            }
        }
        if( property_exists( $this, $name ) )
        {
            return $this->$name;
        }
        
        return null;
    }
    
    /**
     * Check if an item exists matching the given name
     * 
     * @param string $name
     * @return boolean
     */
    public function __isset( $name ) 
    {
        $value = self::__get( $name );
      
        return !empty( $name );
    }
}

