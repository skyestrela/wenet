--
-- Author:        Pierre-Henry Soria <hello@ph7cms.com>
-- Copyright:     (c) 2019, Pierre-Henry Soria. All Rights Reserved.
-- License:       MIT License
--

-- Fix wrong SQL type for expirationDays (when has more than '255' as value)
ALTER TABLE ph7_memberships MODIFY expirationDays smallint(4) unsigned NOT NULL;

-- Update pH7Builder's SQL schema version
UPDATE ph7_modules SET version = '1.5.6' WHERE vendorName = 'pH7Builder';
