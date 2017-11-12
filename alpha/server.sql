use alpha;

create table server_report (
    id          integer         not null auto_increment,
    userid      integer         not null,
    version     varchar(64)    not null,
    test_group  varchar(64)    not null,
    status      integer         not null,
    comment     text,
    mod_time    timestamp,
    primary key (id),
    unique (userid, version, test_group),
    index sr_vers (version)
);
