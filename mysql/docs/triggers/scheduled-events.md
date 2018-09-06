# Scheduled Events

* [Event Scheduler Configuration](#event-scheduler-configuration)
* [Show Events](#show-events)
* [Create New Events](#create-new-events)
* [Modify Events](#modify-events)
* [Drop Events](#drop-events)

A MySQL event is a task that runs based on a predefined schedule therefore sometimes it is referred to as a scheduled event. MySQL event is also known as “temporal trigger” because it is triggered by time, not by table update like a trigger. A MySQL event is similar to a cron job in UNIX or a task scheduler in Windows.

### Event Scheduler Configuration
MySQL uses a special thread called `event schedule thread` to execute all scheduled events. You can see the status of event scheduler thread by executing the following command:
```sql
SHOW PROCESSLIST;
```
By default, the event scheduler thread is not enabled. To enable and start the event scheduler thread, you need to execute the following command:
```sql
SET GLOBAL event_scheduler = ON;
```

### Show Events
```sql
SHOW EVENTS FROM database_name;
```

### Create New Events
```sql
CREATE EVENT [IF NOT EXIST]  event_name
ON SCHEDULE schedule
DO
event_body
```
You put a schedule after the `ON SCHEDULE` clause.
* If the event is a one-time event, you use the syntax:`AT timestamp [+ INTERVAL]`.
```sql
CREATE EVENT IF NOT EXISTS test_event_01
ON SCHEDULE AT CURRENT_TIMESTAMP
DO
...
```
* If the event is a recurring event, you use the `EVERY` clause: `EVERY interval STARTS timestamp [+INTERVAL] ENDS timestamp [+INTERVAL]`.
```sql
CREATE EVENT IF NOT EXISTS test_event_03
ON SCHEDULE EVERY 1 MINUTE
STARTS CURRENT_TIMESTAMP
ENDS CURRENT_TIMESTAMP + INTERVAL 1 HOUR
DO
...
```

An event is automatically dropped when it is expired. In case, it is a one-time event and expired when its execution completed. To change this behavior, you can use the `ON COMPLETION PRESERVE` clause.
```sql
CREATE EVENT test_event_02
ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 MINUTE
ON COMPLETION PRESERVE
DO
...
```

It is important to notice that you can call a `stored procedure` inside the body of the event. In case you have compound SQL statements, you can wrap them in a `BEGIN END` block.

### Modify Events
you use the `ALTER EVENT` statement as follows:
```sql
ALTER EVENT event_name
ON SCHEDULE schedule
ON COMPLETION [NOT] PRESERVE
RENAME TO new_event_name
ENABLE | DISABLE
DO
    event_body
```
You can use any part to change what you want, you don't need to use the complete syntax.
* `ENABLE | DISABLE` use to enable a disabled event.
* `RENAME` can use to rename the event or move it to another database.
```sql
ALTER EVENT oldDb.test_event_05
RENAME TO newDb.test_event_05
```

### Drop Events
```sql
DROP EVENT [IF EXIST] event_name;
```
