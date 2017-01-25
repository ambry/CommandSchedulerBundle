<?php

namespace JMose\CommandSchedulerBundle\Entity;

/**
 * Entity ScheduledCommand
 *
 * @author  Julien Guyon <julienguyon@hotmail.com>
 * @package JMose\CommandSchedulerBundle\Entity
 */
class ScheduledCommand
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $command;

    /**
     * @var string
     */
    private $arguments;

    /**
     * @var string
     */
    private $options;

    /**
     * @see http://www.abunchofutils.com/utils/developer/cron-expression-helper/
     * @var string
     */
    private $cronExpression;

    /**
     * @var \DateTime
     */
    private $lastExecution;

    /**
     * @var integer
     */
    private $lastReturnCode;

    /**
     * Log's file name (without path)
     *
     * @var string
     */
    private $logFile;

    /**
     * @var integer
     */
    private $priority;

    /**
     * If true, command will be execute next time regardless cron expression
     *
     * @var boolean
     */
    private $executeImmediately;

    /**
     * @var boolean
     */
    private $disabled;

    /**
     * @var boolean
     */
    private $locked;

    /**
     * Init new ScheduledCommand
     */
    public function __construct()
    {
        $this->setLastExecution(new \DateTime());
        $this->setLocked(false);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set id
     *
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ScheduledCommand
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get command
     *
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set command
     *
     * @param string $command
     * @return ScheduledCommand
     */
    public function setCommand($command)
    {
        $this->command = $command;

        return $this;
    }

    /**
     * Get arguments
     *
     * @return string
     */
    public function getArguments($isArray=false)
    {
        if ($isArray === false) {
            return $this->arguments;
        }
        return explode(' ', preg_replace('/\s+/', ' ', $this->arguments));
    }

    /**
     * Set arguments
     *
     * @param string $arguments
     * @return ScheduledCommand
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;

        return $this;
    }

    /**
     * Get options - get the options provided as an array, which may contain sub-arrays
     * for options passed as multiple values
     *
     * @param bool $toArray
     * @return array
     */
    public function getOptions($isArray=false)
    {
        if ($isArray ===  false) {
            return $this->options;
        }

        $optsArray = array();
        if (null !== $this->options || '' != $this->options) {
            $flatOptsArray = explode(' ', preg_replace('/\s+/', ' ', $this->options));
            foreach ($flatOptsArray as $option) {
                // only use one equals to delimit the name from value
                $tmpArray = explode('=', $option, 1);
                if (isset($optsArray[$tmpArray[0]]) && count($tmpArray) > 1) {
                    if (is_array($optsArray[$tmpArray[0]])) {
                        $optsArray[$tmpArray[0]] []= $tmpArray[1];
                    } else {
                        $optsArray[$tmpArray[0]] = array($optsArray[$tmpArray[0]], $tmpArray[1]);
                    }
                } elseif(count($tmpArray) > 1) {
                    $optsArray[$tmpArray[0]] = $tmpArray[1];
                } else {
                    $optsArray[$tmpArray[0]] = true;
                }

            }

        }
        return $optsArray;
    }

    /**
     * Set options
     *
     * @param string $options
     * @return ScheduledCommand
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get cronExpression
     *
     * @return string
     */
    public function getCronExpression()
    {
        return $this->cronExpression;
    }

    /**
     * Set cronExpression
     *
     * @param string $cronExpression
     * @return ScheduledCommand
     */
    public function setCronExpression($cronExpression)
    {
        $this->cronExpression = $cronExpression;

        return $this;
    }

    /**
     * Get lastExecution
     *
     * @return \DateTime
     */
    public function getLastExecution()
    {
        return $this->lastExecution;
    }

    /**
     * Set lastExecution
     *
     * @param \DateTime $lastExecution
     * @return ScheduledCommand
     */
    public function setLastExecution($lastExecution)
    {
        $this->lastExecution = $lastExecution;

        return $this;
    }

    /**
     * Get logFile
     *
     * @return string
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * Set logFile
     *
     * @param string $logFile
     * @return ScheduledCommand
     */
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;

        return $this;
    }

    /**
     * Get lastReturnCode
     *
     * @return integer
     */
    public function getLastReturnCode()
    {
        return $this->lastReturnCode;
    }

    /**
     * Set lastReturnCode
     *
     * @param integer $lastReturnCode
     * @return ScheduledCommand
     */
    public function setLastReturnCode($lastReturnCode)
    {
        $this->lastReturnCode = $lastReturnCode;

        return $this;
    }

    /**
     * Get priority
     *
     * @return integer
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param integer $priority
     * @return ScheduledCommand
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get executeImmediately
     *
     * @return bool
     */
    public function isExecuteImmediately()
    {
        return $this->executeImmediately;
    }

    /**
     * Get executeImmediately
     *
     * @return boolean
     */
    public function getExecuteImmediately()
    {
        return $this->executeImmediately;
    }

    /**
     * Set executeImmediately
     *
     * @param $executeImmediately
     * @return ScheduledCommand
     */
    public function setExecuteImmediately($executeImmediately)
    {
        $this->executeImmediately = $executeImmediately;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function isDisabled()
    {
        return $this->disabled;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     * @return ScheduledCommand
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Locked Getter
     *
     * @return boolean
     */
    public function isLocked()
    {
        return $this->locked;
    }

    /**
     * locked Getter
     *
     * @return boolean
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * locked Setter
     *
     * @param boolean $locked
     * @return $this
     */
    public function setLocked($locked)
    {
        $this->locked = $locked;

        return $this;
    }

}
