<?php

Event::listen('Droit.*', 'Droit\Listener\EmailNotifier');