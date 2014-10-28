<?php

namespace mindplay\spatch;

/**
 * This interface defines a type of result, e.g. something returned by an
 * action-method by a controller.
 *
 * NOTE: unlike Deliverable results, a Dispatchable result MUST NOT send
 * headers or output any content.
 *
 * @see Deliverable similar to Dispatchable, but expected to produce output
 * @see Dispatcher dispatches the result
 */
interface Dispatchable
{
    /**
     * Dispatches the result (does not send headers or produce output)
     *
     * @return Dispatchable|Deliverable|null|void
     */
    function dispatch();
}
