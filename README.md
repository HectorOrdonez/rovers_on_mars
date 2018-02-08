# Hector assessment for Werkspot

## Assumptions

Rovers are not suicidal. If the command pushes them over the cliff they will just stop there. That is still considered an acceptable command.

Rovers are solid and aware of each other. If Rover 2 is asked to move to the same position of through the same position as Rover 1, it will stop there and will not take further instructions.

Program will stop if any of the instructions is invalid. This means that if the movement instruction contains something different than L, R or M the program will complain and nothing will be moved.

Rovers cannot appear outside the Plateau. Since we know the dimensions of it when Rover starting point is inputted, program will complain that Rover cannot start there.

## Instructions

Run the command as follows:

```
php app.php run "5 5" "1 1 N" "LMLML" "3 3 E" "MMRMRM"
```

## Notes

I did not have time to finish the exercise.

Missing features:

1) The Plateau does not interact with Rovers. Ideally the rovers would have asked the Plateau if next position is off-limits.

2) The Rovers do not check if previous rover is in next position. Like in previous point I would have liked to have the rover "shut down" in such case.
