import { useEffect, useState } from "react";

type Player = {
  username: string;
  score: number;
  prestige: number;
};

export function Leaderboard() {
  const [players, setPlayers] = useState<Player[]>([]);

  const fetchLeaderboard = async () => {
    try {
      const res = await fetch("/leaderboard");
      const data = await res.json();
      setPlayers(data);
      console.log("Fetched leaderboard data:", data);
    } catch (err) {
      console.error(err);
    }
  };

  useEffect(() => {
    fetchLeaderboard();

    const interval = setInterval(fetchLeaderboard, 60000);

    return () => clearInterval(interval);
  }, []);

  return (
    <div className="leaderboard">
      <h2>Top Players</h2>

      <ol>
        {players.map((player, index) => (
          <li key={index}>
            #{index + 1} — <strong>{player.username}</strong>  
            {" "}({player.score}) P{player.prestige}
          </li>
        ))}
      </ol>
    </div>
  );
}