mindplay/spatch
---------------

This library is more about defining the flow of dispatch and delivery
in a web application, more so than actually implementing anything.

The goal is to separate the output of headers and content from any other
activities that do not produce output.

There are three important reasons to enforce this separation:

 1. Separation: it is easier to understand code that deals exclusively
    with output *or* behavior, never with both.

 2. Control: avoid PHP gotchas where some operation caused output to
    start prematurely, preventing you from sending a header or setting
    session a variable, etc.

 3. Testing: separation enables testing in stages, e.g. testing the result
    of dispatch, such as the selected view-template and variables, versus
    actually testing what gets rendered.

Two interfaces define a pair of concepts: two types of result which may
be returned e.g. by action-methods in controllers:

 * **Dispatchable** results do *not* send headers or content - they simply
   dispatch and perform whatever action it is they perform, which could be
   anything, as long as it doesn't cause any headers or content to be output.

 * **Deliverable** results actually deliver the result, which means sending
   headers and/or content - this could be anything, from a simple HTTP status
   code for redirection, to rendering a view or sending an image or file.

The two interfaces as such are similar - `Dispatchable::dispatch()` should
return either another `Dispatchable`, or a `Deliverable`, whereas
`Deliverable::deliver()` should return nothing and produce a response.

A simple `Dispatcher` class is included, which will accept a `Dispatchable` or
`Deliverable` - it will `dispatch()` until a final `Deliverable` is returned,
and then finally `deliver()` the result.

The dispatcher enforces separation and flow by throwing an exception if the
final result is not a `Deliverable`, and it will also throw if a `Dispatchable`
produces any output prematurely.

This may be easier to understand by actually reading the source code of the
`Dispatcher` which is just a few lines of code.
