dinomo-fe
(isset($data['id']))? $data['id'] : null;
./vendor/bin/doctrine-module orm:schema-tool:create
dbal:import Import SQL file(s) directly to Database.
dbal:run-sql Executes arbitrary SQL directly from the command line.
orm:clear-cache:metadata Clear all metadata cache of the various cache drivers.
orm:clear-cache:query Clear all query cache of the various cache drivers.
orm:clear-cache:result Clear result cache of the various cache drivers.
orm:convert-d1-schema Converts Doctrine 1.X schema into a Doctrine 2.X schema.
orm:convert-mapping Convert mapping information between supported formats.
orm:ensure-production-settings Verify that Doctrine is properly configured for a production environment.
orm:generate-entities Generate entity classes and method stubs from your mapping information.
orm:generate-proxies Generates proxy classes for entity classes.
orm:generate-repositories Generate repository classes from your mapping information.
orm:run-dql Executes arbitrary DQL directly from the command line.
orm:schema-tool:create Processes the schema and either create it directly on EntityManager Storage Connection or generate the SQL output.
orm:schema-tool:drop Processes the schema and either drop the database schema of EntityManager Storage Connection or generate the SQL output.
orm:schema-tool:update Processes the schema and either update the database schema of EntityManager Storage Connection or generate the SQL output.