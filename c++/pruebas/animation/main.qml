import QtQuick 2.12
import QtQuick.Window 2.12

Window {
    id: mainWindow
    visible: true
    width: 640
    height: 480
    title: qsTr("Hello World")
    color: "cyan";

    Component.onCompleted: showMaximized();
    Item {
        id: mainItem
        anchors.fill: parent
        focus: true
        Keys.onPressed: {
            //if (event.key === Qt.Key_Space) console.log("Space Key")
            console.log(switchKey(event.key));
        }
        Rectangle{
            id: greenRectagle
            //anchors.left: parent.left
            //anchors.right: parent.right
            width: 1600
            anchors.top: parent.verticalCenter
            anchors.bottom: parent.bottom
            color: "green"
            Image { source: "images/texture.jpg"; fillMode: Image.Tile; anchors.fill: parent;  opacity: 0.3 }
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
            /*interpolate: false*/
            y: 240
        }
    }

    function switchKey(key){
        switch(key){
        case Qt.Key_Space:
            return "space";
        default:
            return false;
        }
    }
}
