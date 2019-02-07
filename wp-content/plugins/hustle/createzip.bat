@echo off
for /F "usebackq tokens=1,2 delims==" %%i in (`wmic os get LocalDateTime /VALUE 2^>NUL`) do if '.%%i.'=='.LocalDateTime.' set ldt=%%j
set ldt=%ldt:~4,2%-%ldt:~6,2%-%ldt:~0,4%
set filename=hustle-%ldt%.zip
echo Generating zip file: "%filename%"
zip -r ../%filename% ./* -x "./.git/*" "./.*" "./composer.*" "./Gulpfile.js" "./node_modules/*" "./package.json" "./assets/sass/*" "./createzip.sh" "./createzip.bat"
