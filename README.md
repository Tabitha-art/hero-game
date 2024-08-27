# Hero Game

## The Story

Once upon a time, there was a great hero named **Orderus**. After battling monsters for over a hundred years, Orderus now has the following stats:

- **Health**: 70 - 100
- **Strength**: 70 - 80
- **Defence**: 45 - 55
- **Speed**: 40 - 50
- **Luck**: 10% - 30%

### Skills:
- **Rapid Strike**: A 10% chance to strike twice on attack.
- **Magic Shield**: A 20% chance to take only half damage on defense.

## The Wild Beast

During his journey in the forests of Emagia, Orderus encounters a wild beast with these stats:

- **Health**: 60 - 90
- **Strength**: 60 - 90
- **Defence**: 40 - 60
- **Speed**: 40 - 60
- **Luck**: 25% - 40%

## Gameplay

This game simulates a battle between **Orderus** and a **wild beast**. The stats for each character are randomly generated within the defined ranges at the start of every battle.

### Battle Rules:
- The player with the higher **speed** attacks first. If both have equal speed, the player with the higher **luck** attacks first.
- After each attack, the roles switch between attacker and defender.
- The damage is calculated as: `Damage = Attacker's strength - Defender's defence`

- If the defender gets lucky, they can avoid the attack completely.
- **Orderus' Skills** may activate randomly:
    - **Rapid Strike**: 10% chance to attack twice in one turn.
    - **Magic Shield**: 20% chance to take only half damage while defending.

### Game Over:
- The game ends when one character's **health** reaches 0 or after **20 turns**.
- If a character's health reaches 0 before 20 turns, the other character is the winner.
- If no winner is found after 20 rounds, the game ends in a **draw**.

## Output

For each turn, the game outputs:
- Turn number
- Which skills were used (if any)
- The damage dealt
- Remaining health of the defender

The winner is announced if one character loses all their health before 20 rounds, otherwise the game ends in a draw.

## Running the Game

To run the game via the command line, navigate to the project directory and run:
```bash
php start-game.php
