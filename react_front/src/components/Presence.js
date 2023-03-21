import axios from 'axios';
import { useEffect, useState } from 'react';
import { useParams } from 'react-router-dom';

function PresenceList() {
  const { orgId, buildingId, pieceId } = useParams();
  const [presence, setPresence] = useState([]);

  useEffect(() => {
    let url = 'http://127.0.0.1:8000/api/buildings';
    if (orgId) url += `?org=${orgId}`;
    if (buildingId) url += `&building=${buildingId}`;
    if (pieceId) url += `&piece=${pieceId}`;

    axios.get(url).then((response) => {
      setPresence(response.data.count);
    });
  }, [orgId, buildingId, pieceId]);

  return (
    <div>
      <h1>Liste de présence</h1>
      <p>Nombre de personnes présentes : {presence}</p>
    </div>
  );
}

export default PresenceList;
