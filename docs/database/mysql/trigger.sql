create table pseudohash(
	`id` int(10) unsigned not null auto_increment,
	`url` varchar(255) not null,
	`crc` int(10) unsigned not null default '0',
	primary key (`id`) using btree
);

delimiter |

create trigger pseudohash_crc_insert before insert on pseudohash for each row 
begin set @x = "hello trigger";
    set NEW.crc=crc32(NEW.url);
end;
|

create trigger pseudohash_crc_update before update on pseudohash for each row 
begin set @x = "hello trigger";
    set NEW.crc=crc32(NEW.url);
end;
|

delimiter ;
