DB::statement(
    '
        SELECT
            tkt.id AS ticket_id
            , tkt.title
            , tkt.description
            , tkt.created_at
            , tkt.updated_at
            , tkt.user_id
            , usr.first_name
            , usr.last_name
            , tkt.priority_id
            , prt.priority
            , tkt.type_id
            , ttp.type
            , tkt.status_id
            , stt.status
            , tkt.category_id
            , ctt.category
            , COUNT(att.id) AS activities_count
            , COUNT(cmt.id) AS comments_count
        FROM
            tickets tkt
        INNER JOIN
            users               usr ON  1 = 1
                                    AND tkt.user_id = usr.id
        LEFT JOIN
            activities_tickets  att ON 1 = 1
                                    AND tkt.id = att.ticket_id
        LEFT JOIN
            comments_tickets    cmt ON 1 = 1
                                    AND tkt.id = cmt.ticket_id
        INNER JOIN
            priorities_tickets  prt ON 1 = 1
                                    AND tkt.priority_id = prt.id
        INNER JOIN
            ticket_types        ttp ON 1 = 1
                                    AND tkt.type_id = ttp.id
        INNER JOIN
            status_tickets      stt ON 1 = 1
                                    AND tkt.status_id = stt.id
        INNER JOIN
            categories_tickets  ctt ON 1 = 1
                                    AND tkt.category_id = ctt.id
        WHERE
            1 = 1
        GROUP BY
            tkt.id
            , tkt.title
            , tkt.description
            , tkt.created_at
            , tkt.updated_at
            , tkt.user_id
            , usr.first_name
            , usr.last_name
            , tkt.priority_id
            , prt.priority
            , tkt.type_id
            , ttp.type
            , tkt.status_id
            , stt.status
            , tkt.category_id
            , ctt.category
    '
);
