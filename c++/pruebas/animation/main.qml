import QtQuick 2.12
import QtQuick.Window 2.12
import QtQml 2.12

Window {
    id: mainWindow
    visible: true
    width: 640
    height: 480
    title: qsTr("Hello World")
    color: "cyan";

    //Component.onCompleted: showMaximized();
    Item {
        id: mainItem
        anchors.fill: parent
        focus: true
        Keys.onPressed: {
            mainWindow.switchKey(event.key);
        }

        Timer{
            id: gravity
            interval: 250
            running: true
            repeat: true
            onTriggered: mainWindow.gravity();
        }

        Item{
            id: itemMonster
            anchors.fill: parent
            Timer {
                interval: 500
                running: true
                repeat: true
                onTriggered: mainWindow.createObjects(itemMonster, Screen.desktopAvailableWidth, Screen.desktopAvailableHeight / Math.floor((Math.random() * 10)));
            }
        }

        Rectangle{
            id: greenRectagle
            width: Screen.desktopAvailableWidth + 174
            anchors.top: parent.verticalCenter
            anchors.bottom: parent.bottom
            color: "green"

            Image {
                source: "images/texture.jpg"
                fillMode: Image.Tile
                anchors.fill: parent
            }

            NumberAnimation on x{
                from: 0
                to: -174
                duration: 1000
                loops: Animation.Infinite
            }
        }

        AnimatedSprite {
            width: 125
            height: 127
            id: spriteImage
            source: "images/sprite4.png"
            frameWidth: 250
            frameHeight: 245
            frameCount: 6
            frameDuration: 60
            frameY : 0
            interpolate: false
            y: Screen.desktopAvailableHeight / 2 - spriteImage.height
        }
    }

    function jump(){
        spriteImage.y = spriteImage.y - 50;
        gravity.restart();
    }

    function gravity(){
        spriteImage.y = Screen.desktopAvailableHeight / 2 - spriteImage.height
    }

    function switchKey(key){
        switch(key){
        case Qt.Key_Space:
            jump();
            break;
        default:
            return false;
        }
    }

    function createObjects(parentItem, x, y){
        var newObject = Qt.createQmlObject('import QtQuick 2.12;import QtQuick.Window 2.12;
            Rectangle {color:"cyan";width: 50;height: 50;x: ' + x + ';y: ' + y + ';
            NumberAnimation on x{from: ' + x + ';to: -100;duration: 3500;}AnimatedSprite {
            anchors.fill: parent;source: "images/bird.png";frameWidth: 240;frameHeight: 314;
            frameCount: 20;frameDuration: 60;frameY : 0;interpolate: false;}}',
            parentItem,"dinamicObject");

        newObject.destroy(3750);
    }
}
