<?php
// This file is part of Moodle - https://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin observer classes are defined here.
 *
 * @package     local_smartupdater
 * @category    event
 * @copyright   2022 Brad Pasley <bradpaslery@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_smartupdater;

defined('MOODLE_INTERNAL') || die();


/**
 * Event observer class.
 *
 * @package    local_smartupdater
 * @copyright  2022 Brad Pasley <bradpaslery@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class observer {

    /**
     * Triggered via $event.
     *
     * @param core\event\user_created $event The event.
     * @return bool True on success.
     */
    public static function user_created($event) {

        // For more information about the Events API, please visit:
        // https://docs.moodle.org/dev/Event_2

        global $DB, $USER;

        // Setup: Initialise Variables.
        $data                = $event->get_data();
        $enroleduserid       = $data['relateduserid'];
        $affecteduser        = current($DB->get_records('user', array('id' => $enroleduserid)));
        $affecteduser->msn   = "You've been updated!";

        \user_update_user($affecteduser);

        return true;
    }

    /**
     * Triggered via $event.
     *
     * @param \core\event\user_enrolment_created $event The event.
     * @return bool True on success.
     */
    public static function enrolment_created($event) {

        // For more information about the Events API, please visit:
        // https://docs.moodle.org/dev/Event_2

        return true;
    }
}
