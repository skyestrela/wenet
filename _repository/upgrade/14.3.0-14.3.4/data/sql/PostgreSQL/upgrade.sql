--
-- Author:        Pierre-Henry Soria <hi@ph7.me>
-- Copyright:     (c) 2018-2019, Pierre-Henry Soria. All Rights Reserved.
-- License:       MIT License
--

-- Update Social Media Widgets provider (from AddThis to AddToAny)
UPDATE ph7_static_files SET file = '//static.addtoany.com/menu/page.js' WHERE staticId = 1;


-- Update pH7Builder's SQL schema version
UPDATE ph7_modules SET version = '1.4.9' WHERE vendorName = 'pH7Builder';
