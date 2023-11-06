<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Rest\Video\V1\CompositionContext;
use Twilio\Rest\Video\V1\CompositionHookContext;
use Twilio\Rest\Video\V1\CompositionHookList;
use Twilio\Rest\Video\V1\CompositionList;
use Twilio\Rest\Video\V1\CompositionSettingsList;
use Twilio\Rest\Video\V1\RecordingContext;
use Twilio\Rest\Video\V1\RecordingList;
use Twilio\Rest\Video\V1\RecordingSettingsList;
use Twilio\Rest\Video\V1\RoomContext;
use Twilio\Rest\Video\V1\RoomList;
use Twilio\Version;

/**
 * @property CompositionHookList compositionHooks
 * @property CompositionSettingsList compositionSettings
 * @property RecordingList recordings
 * @property RecordingSettingsList recordingSettings
 * @property CompositionList compositions
 * @property RoomList rooms
 * @method CompositionHookContext compositionHooks(string $sid)
 * @method RecordingContext recordings(string $sid)
 * @method CompositionContext compositions(string $sid)
 * @method RoomContext rooms(string $sid)
 */
class V1 extends Version {
    protected $_compositionHooks = null;
    protected $_compositionSettings = null;
    protected $_recordings = null;
    protected $_recordingSettings = null;
    protected $_compositions = null;
    protected $_rooms = null;

    /**
     * Construct the V1 version of Video
     * 
     * @param Domain $domain Domain that contains the version
     * @return V1 V1 version of Video
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
        return '[Twilio.Video.V1]';
    }

    /**
     * @return CompositionHookList
     */
    protected function getCompositionHooks() {
        if (!$this->_compositionHooks) {
            $this->_compositionHooks = new CompositionHookList($this);
        }
        return $this->_compositionHooks;
    }

    /**
     * @return CompositionSettingsList
     */
    protected function getCompositionSettings() {
        if (!$this->_compositionSettings) {
            $this->_compositionSettings = new CompositionSettingsList($this);
        }
        return $this->_compositionSettings;
    }

    /**
     * @return RecordingList
     */
    protected function getRecordings() {
        if (!$this->_recordings) {
            $this->_recordings = new RecordingList($this);
        }
        return $this->_recordings;
    }

    /**
     * @return RecordingSettingsList
     */
    protected function getRecordingSettings() {
        if (!$this->_recordingSettings) {
            $this->_recordingSettings = new RecordingSettingsList($this);
        }
        return $this->_recordingSettings;
    }

    /**
     * @return CompositionList
     */
    protected function getCompositions() {
        if (!$this->_compositions) {
            $this->_compositions = new CompositionList($this);
        }
        return $this->_compositions;
    }

    /**
     * @return RoomList
     */
    protected function getRooms() {
        if (!$this->_rooms) {
            $this->_rooms = new RoomList($this);
        }
        return $this->_rooms;
    }
}