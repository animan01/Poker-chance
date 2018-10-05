## Poker chance calculator

Step 1. User should select a suit and a card rank.

Step 2. User starts drafting cards, one by one.

Step 3. Website should display a chance of getting customer selected card on the next Draft.
If customer selected card is drafted website should display popup with a message "Got it, the chance was
(current chance of getting the card)%" and reset to step 1.


## How to run

* `$ composer install`
* `$ php bin/console server:run`
* open in browser http://127.0.0.1:8000/
* run test `$ phpunit`
* build style and js `$ yarn encore dev`