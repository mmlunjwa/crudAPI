CREATE TABLE IF NOT EXISTS show_presenter (
    id INT AUTO_INCREMENT,
    presenter_id INT NOT NULL,
    show_id INT NOT NULL,
    PRIMARY KEY (id),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP,
    deleted_at  timestamp,
    FOREIGN KEY (presenter_id) REFERENCES presenters(id),
    FOREIGN KEY (show_id) REFERENCES shows(id)
);


CREATE TABLE IF NOT EXISTS slots (
    id INT AUTO_INCREMENT,
    station_id INT NOT NULL,
    show_id INT NOT NULL,
    time_in varchar(255),
    time_out varchar(255),
    day_of_week varchar(255),
    PRIMARY KEY (id),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP,
    deleted_at  timestamp,
    FOREIGN KEY (station_id) REFERENCES stations(id),
    FOREIGN KEY (show_id) REFERENCES shows(id)
);