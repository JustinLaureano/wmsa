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
