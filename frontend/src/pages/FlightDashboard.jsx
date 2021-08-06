import React from 'react';
import {bonvoyageApi} from "../Links"
import {
    Table,
    TableBody,
    TableCell,
    TableContainer,
    TableHead,
    TableRow,
    Paper,
    makeStyles
} from '@material-ui/core';


const useStyles = makeStyles({
    table: {
        minWidth: 650,
        maxWidth: 1240,
        marginLeft: "auto",
        marginRight: "auto"
    },
    headRow: {

    },
    headRowCell: {
        fontSize: "22px",
        fontFamily: "Fira Sans",
    }
});

const headCells = [
    {
        id: "Flight"
    },
    {
        id: "Departure"
    },
    {
        id: "Departure Time"
    },
    {
        id: "Destination"
    },
    {
        id: "Arrival Time"
    },
    {
        id: "Airline"
    },
    {
        id: "Available tickets"
    },
];


export default function FlightDashboard(){

    const classes = useStyles();

    const [rows, setRows] = React.useState([]);

    React.useEffect(() => {
        fetch(`${bonvoyageApi}/api/flights`)
            .then(res => res.json())
            .then(
                (result) => {
                    console.log(result);
                    setRows(result);
                },
                (error) => {
                    console.log(error);
                }
            )
    }, [])

    return (
        <>
            <TableContainer component={Paper}>
                <Table className={classes.table} size="small" aria-label="a dense table">
                    <TableHead>
                        <TableRow
                            className={classes.headRow}
                            hover={true}>
                            {headCells.map((cell) => (
                                <TableCell className={classes.headRowCell} key={cell.id} align="right">{cell.id}</TableCell>
                            ))}
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {rows.map((row) => (
                            <TableRow key={row.name}>
                                <TableCell component="th" scope="row">
                                    {row.flight_name}
                                </TableCell>
                                <TableCell align="right">{row.departure}</TableCell>
                                <TableCell align="right">{row.departure_time}</TableCell>
                                <TableCell align="right">{row.destination}</TableCell>
                                <TableCell align="right">{row.arrival_time}</TableCell>
                                <TableCell align="right">{row.airline}</TableCell>
                                <TableCell align="right">{row.tickets.length}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>
        </>
    );
}