CREATE OR REPLACE TRIGGER TRIG_PROD 
BEFORE DELETE OR UPDATE
ON PRODUIT FOR EACH ROW

begin
if DELETING then
	if :old.qtes<>0 then
		raise_application_error(-20005,'IMPOSSIBLE DE SUPPRIMRER : stock non nul');
	end if;
end if;

if UPDATING then
	if :new.qtes<0 then
		raise_application_error(-20006,'IMPOSSIBLE DE MODIFIER : stock negatif');
	end if;
end if;
end;
/
