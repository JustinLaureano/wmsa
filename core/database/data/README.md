# Data Collection


## Introduction

Document to outline all data collection methodology used and the reasoning behind it.


## Collection Methods



## Storage Locations

The storage locations have been imported by area category.


### Machines

The machines will be imported as one whole list with a default machine type. Then this value can be changed for each machine as necessary once it has been exported out of the database.

I believe the efforts to dynamically determine the type based on the area name ouyweigh the benefits.

To build `machines.csv` file

`wms` database

```sql
SELECT
    building,
    id,
    area,
    disabled,
    'press' as 'machine_type'
FROM wms.tblwms_rack_location
where type = 20
group by id
order by id asc;
```


### Material Types


This is a new category that is not in the legacy WMS system so there is no import statement. The initial seed file is the only thing needed here.



### Materials

Materials will be sourced through the view via the following statement

`company` database

```sql
SELECT
	COALESCE(psam_part_number, '') AS material_number,
	COALESCE(bapm_part_number, '') AS part_number,
    COALESCE(material_description, '') AS material_description,
    COALESCE(base_quantity, '') AS base_quantity,
    COALESCE(base_uom, '') AS base_unit_of_measure
FROM prospira_web.view_sap_material_labor;
```

