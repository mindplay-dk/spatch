<?php

namespace mindplay\spatch;

/**
 * This interface defines a result that may be returned by a Dispatchable,
 * which can be delivered by a Dispatcher.
 *
 * NOTE: unlike Dispatchable types, Deliverable result types are expected
 * to send headers and/or output content - delivering the result of the
 * current web request.
 *
 * @see Dispatcher dispatches the result
 */
interface Deliverable
{
    /**
     * Delivers the result (sends headers, produces output, etc.)
     *
     * @return void
     */
    function deliver();
}
