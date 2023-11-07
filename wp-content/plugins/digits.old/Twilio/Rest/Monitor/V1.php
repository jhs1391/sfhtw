<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Monitor;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Rest\Monitor\V1\AlertContext;
use Twilio\Rest\Monitor\V1\AlertList;
use Twilio\Rest\Monitor\V1\EventContext;
use Twilio\Rest\Monitor\V1\EventList;
use Twilio\Version;

/**
 * @property AlertList alerts
 * @property EventList events
 * @method AlertContext alerts(string $sid)
 * @method EventContext events(string $sid)
 */
class V1 extends Version {
    protected $_alerts = null;
    protected $_events = null;

    /**
     * Construct the V1 version of Monitor
     * 
     * @param Domain $domain Domain that contains the version
     * @return V1 V1 version of Monitor
     */
    public function __construct(Domain $domain) {
        parent::__construct($domain);
        $this->version = 'v1';
    }

    /**
     * Magic getter to lazy load root resources
     *
     * @param string $name Resource to return
     *
     * @return ListResource The requested resource
     * @throws TwilioException For unknown resource
     */
    public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown resource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     *
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Monitor.V1]';
    }

    /**
     * @return AlertList
     */
    protected function getAlerts() {
        if (!$this->_alerts) {
            $this->_alerts = new AlertList($this);
        }
        return $this->_alerts;
    }

    /**
     * @return EventList
     */
    protected function getEvents() {
        if (!$this->_events) {
            $this->_events = new EventList($this);
        }
        return $this->_events;
    }
}