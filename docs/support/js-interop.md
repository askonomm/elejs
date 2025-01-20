# JavaScript Interop Support

A list of JS API definitions which need to be implemented for being able to use JS API's from within PHP.

#### Global / `window`

- [x] `Jsi::alert`

#### `Document`

- [ ] `Jsi\Document::adoptNode`
- [ ] `Jsi\Document::append`
- [ ] `Jsi\Document::caretPositionFromPoint`
- [ ] `Jsi\Document::close`
- [ ] `Jsi\Document::createAttribute`
- [ ] `Jsi\Document::createAttributeNS`
- [ ] `Jsi\Document::createCDATASection`
- [ ] `Jsi\Document::createComment`
- [ ] `Jsi\Document::createDocumentFragment`
- [ ] `Jsi\Document::createElement`
- [ ] `Jsi\Document::createElementNS`
- [ ] `Jsi\Document::createExpression`
- [ ] `Jsi\Document::createNodeIterator`
- [ ] `Jsi\Document::createProcessingInstruction`
- [ ] `Jsi\Document::createRange`
- [ ] `Jsi\Document::createTextNode`
- [ ] `Jsi\Document::createTreeWalker`
- [ ] `Jsi\Document::elementFromPoint`
- [ ] `Jsi\Document::elementsFromPoint`
- [ ] `Jsi\Document::evaluate`
- [ ] `Jsi\Document::exitFullscreen`
- [ ] `Jsi\Document::exitPictureInPicture`
- [ ] `Jsi\Document::exitPointerLock`
- [ ] `Jsi\Document::getAnimations`
- [ ] `Jsi\Document::getElementById`
- [ ] `Jsi\Document::getElementsByClassName`
- [ ] `Jsi\Document::getElementsByName`
- [ ] `Jsi\Document::getElementsByTagName`
- [ ] `Jsi\Document::getElementsByTagNameNS`
- [ ] `Jsi\Document::getSelection`
- [ ] `Jsi\Document::hasFocus`
- [ ] `Jsi\Document::hasStorageAccess`
- [ ] `Jsi\Document::hasUnpartitionedCookieAccess`
- [ ] `Jsi\Document::importNode`
- [ ] `Jsi\Document::open`
- [ ] `Jsi\Document::prepend`
- [x] `Jsi\Document::querySelector`
- [x] `Jsi\Document::querySelectorAll`
- [ ] `Jsi\Document::replaceChildren`
- [ ] `Jsi\Document::requestStorageAccess`
- [ ] `Jsi\Document::startViewTransition`
- [ ] `Jsi\Document::writeln`

#### `Element`

- [ ] `Jsi\Element::after`
- [ ] `Jsi\Element::animate`
- [ ] `Jsi\Element::append`
- [ ] `Jsi\Element::attachShadow`
- [ ] `Jsi\Element::before`
- [ ] `Jsi\Element::checkVisibility`
- [ ] `Jsi\Element::closest`
- [ ] `Jsi\Element::computedStyleMap`
- [ ] `Jsi\Element::getAnimations`
- [ ] `Jsi\Element::getAttribute`
- [ ] `Jsi\Element::getAttributeNames`
- [ ] `Jsi\Element::getAttributeNode`
- [ ] `Jsi\Element::getAttributeNodeNS`
- [ ] `Jsi\Element::getAttributeNS`
- [ ] `Jsi\Element::getBoundingClientRect`
- [ ] `Jsi\Element::getClientRects`
- [ ] `Jsi\Element::getElementsByClassName`
- [ ] `Jsi\Element::getElementsByTagName`
- [ ] `Jsi\Element::getElementsByTagNameNS`
- [ ] `Jsi\Element::getHTML`
- [ ] `Jsi\Element::hasAttribute`
- [ ] `Jsi\Element::hasAttributeNS`
- [ ] `Jsi\Element::hasAttributes`
- [ ] `Jsi\Element::hasPointerCapture`
- [ ] `Jsi\Element::insertAdjacentElement`
- [ ] `Jsi\Element::insertAdjacentHTML`
- [ ] `Jsi\Element::insertAdjacentText`
- [ ] `Jsi\Element::matches`
- [ ] `Jsi\Element::prepend`
- [x] `Jsi\Element::querySelector`
- [x] `Jsi\Element::querySelectorAll`
- [ ] `Jsi\Element::releasePointerCapture`
- [ ] `Jsi\Element::remove`
- [ ] `Jsi\Element::removeAttribute`
- [ ] `Jsi\Element::removeAttributeNode`
- [ ] `Jsi\Element::removeAttributeNS`
- [ ] `Jsi\Element::replaceChildren`
- [ ] `Jsi\Element::replaceWith`
- [ ] `Jsi\Element::requestFullscreen`
- [ ] `Jsi\Element::requestPointerLock`
- [ ] `Jsi\Element::scroll`
- [ ] `Jsi\Element::scrollBy`
- [ ] `Jsi\Element::scrollIntoView`
- [ ] `Jsi\Element::scrollTo`
- [ ] `Jsi\Element::setAttribute`
- [ ] `Jsi\Element::setAttributeNode`
- [ ] `Jsi\Element::setAttributeNodeNS`
- [ ] `Jsi\Element::setAttributeNS`
- [ ] `Jsi\Element::setHTMLUnsafe`
- [ ] `Jsi\Element::setPointerCapture`
- [ ] `Jsi\Element::toggleAttribute`