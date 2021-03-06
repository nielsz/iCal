<?php

/*
 * This file is part of the eluceo/iCal package.
 *
 * (c) Markus Poerschke <markus@eluceo.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Eluceo\iCal\Component;

use Eluceo\iCal\Component;
use Eluceo\iCal\PropertyBag;

class Calendar extends Component
{
    /**
     * The Product Identifier
     *
     * According to RFC 2445: 4.7.3 Product Identifier
     *
     * This property specifies the identifier for the product that created the Calendar object.
     *
     * @link http://www.ietf.org/rfc/rfc2445.txt
     *
     * @var string
     */
    protected $prodId = null;
    protected $name = null;

    function __construct($prodId)
    {
        if (empty($prodId)) {
            throw new \UnexpectedValueException('PRODID cannot be empty');
        }

        $this->prodId = $prodId;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'VCALENDAR';
    }
    
    public function setName( $name )
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function buildPropertyBag()
    {
        $this->properties = new PropertyBag;
        $this->properties->set('VERSION', '2.0');
        $this->properties->set('PRODID', $this->prodId);
        
        if( $this->name )
            $this->properties->set( 'X-WR-CALNAME', $this->name );
    }

    /**
     * Adds an Event to the Calendar
     *
     * Wrapper for addComponent()
     *
     * @see Eluceo\iCal::addComponent
     *
     * @param Event $event
     */
    public function addEvent(Event $event)
    {
        $this->addComponent($event);
    }

    /**
     * Not needed here.
     *
     * @todo Remove this method
     *
     * @deprecated
     *
     * @return null|string
     */
    public function getProdId()
    {
        return $this->prodId;
    }
}
