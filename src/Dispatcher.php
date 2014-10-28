<?php

namespace mindplay\spatch;

/**
 * Dispatcher for use in a front controller or framework.
 */
class Dispatcher
{
    /**
     * @param Dispatchable|Deliverable $result the result to dispatch and/or deliver
     *
     * @return void
     *
     * @throws DispatchException if the given result could not be delivered
     */
    public function run($result)
    {
        while ($result instanceof Dispatchable) {
            $result = $this->dispatch($result);
        }

        if ($result instanceof Deliverable) {
            $this->deliver($result);
            return;
        }

        throw new DispatchException(get_class($result) . " is not Deliverable");
    }

    /**
     * Dispatch and return the Dispatchable or Deliverable for further processing
     *
     * @param Dispatchable $result result being dispatched
     *
     * @return Dispatchable|Deliverable|null
     *
     * @throws DispatchException if output was started prematurely
     */
    protected function dispatch(Dispatchable $result)
    {
        // the route (or Dispatchable) returned a Dispatchable result:
        $result = $result->dispatch();

        if (headers_sent($file, $line)) {
            // Dispatchable must not produce output - only Deliverable should do that!
            throw new DispatchException("unexpected output from {$file}#{$line}");
        }

        return $result;
    }

    /**
     * Deliver a result
     *
     * @param Deliverable $result
     *
     * @return void
     */
    protected function deliver(Deliverable $result)
    {
        $result->deliver();
    }
}
