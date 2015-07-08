CREATE TABLE tones(
id SERIAL, 
tone text, 
created timestamp default CURRENT_TIMESTAMP, 
done boolean default false
);